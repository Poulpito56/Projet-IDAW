<?php
require_once('init_pdo.php');
header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {

  case 'GET':

    if (isset($_GET['id_aliment'])) {
      $id = $_GET['id_aliment'];

      $request = $pdo->prepare("SELECT * FROM ALIMENT WHERE ID_ALIMENT = '" . $id . "'");


      if ($request->execute()) {
        $reponse = $request->fetchAll(PDO::FETCH_OBJ);
        http_response_code(200);
        echo json_encode($reponse);
      } else {
        http_response_code(500);
        echo json_encode(["message" => "Erreur lors de l'affichage de l'aliment."]);
      }

    } elseif(isset($_GET['type'])){

      $type = $_GET['type'];

      $request = $pdo->prepare("SELECT * FROM ALIMENT WHERE TYPE = '" . $type . "'");


      if ($request->execute()) {
        $reponse = $request->fetchAll(PDO::FETCH_OBJ);
        http_response_code(200);
        echo json_encode($reponse);
      } else {
        http_response_code(500);
        echo json_encode(["message" => "Erreur lors de l'affichage de l'aliment."]);
      }

    } else {
      http_response_code(422);
      echo json_encode(["message" => "Paramètre manquant"]);

      /*** close the database connection ***/
      $pdo = null;

      exit;
    }

    break;

  case 'POST':
    $data = json_decode(file_get_contents('php://input'));


    if (!isset($data->nom) || !isset($data->type)) {
      http_response_code(400);
      echo json_encode(["message" => "Les champs 'Nom' et 'Type' sont obligatoires."]);
    } else {

      $aliment_obj = new stdClass();

      $aliment_obj->ID_ALIMENT = isset($data->id_aliment) ? $data->id_aliment : "0";
      $aliment_obj->NOM = $data->nom;
      $aliment_obj->TYPE = $data->type;
      $aliment_obj->ID_REGIME = isset($data->id_regime) ? $data->id_regime : NULL;
      $aliment_obj->IMAGE_URL = isset($data->image_url) ? $data->image_url : NULL;

      if ($data->type == 0) {
        $aliment_obj->BICARBONATE = isset($data->bicarbonate) ? $data->bicarbonate : NULL;
        $aliment_obj->CALCIUM = isset($data->calcium) ? $data->calcium : NULL;
        $aliment_obj->CHLORURE = isset($data->chlorure) ? $data->chlorure : NULL;
        $aliment_obj->FLUOR = isset($data->fluor) ? $data->fluor : NULL;
        $aliment_obj->MAGNESIUM = isset($data->magnesium) ? $data->magnesium : NULL;
        $aliment_obj->NITRATE = isset($data->nitrate) ? $data->nitrate : NULL;
        $aliment_obj->POTASSIUM = isset($data->potassium) ? $data->potassium : NULL;
        $aliment_obj->SILICE = isset($data->silice) ? $data->silice : NULL;
        $aliment_obj->SODIUM = isset($data->sodium) ? $data->sodium : NULL;
        $aliment_obj->SULFATE = isset($data->sulfate) ? $data->sulfate : NULL;

        $query_first_part = "INSERT INTO ALIMENT (ID_ALIMENT,NOM,TYPE,ID_REGIME,IMAGE_URL,BICARBONATE,CALCIUM,CHLORURE,FLUOR,MAGNESIUM,NITRATE,POTASSIUM,SILICE,SODIUM,SULFATE) VALUES (";
      } else {
        $aliment_obj->GLUCIDE = isset($data->glucide) ? $data->glucide : NULL;
        $aliment_obj->ENERGIE = isset($data->energie) ? $data->energie : NULL;
        $aliment_obj->GRAS = isset($data->gras) ? $data->gras : NULL;
        $aliment_obj->FIBRE = isset($data->fibre) ? $data->fibre : NULL;
        $aliment_obj->PROTEINE = isset($data->proteine) ? $data->proteine : NULL;
        $aliment_obj->SEL = isset($data->sel) ? $data->sel : NULL;
        $aliment_obj->GRAISSES_SATUREES = isset($data->graisses_saturees) ? $data->graisses_saturees : NULL;
        $aliment_obj->SUCRE = isset($data->sucre) ? $data->sucre : NULL;

        $query_first_part = "INSERT INTO ALIMENT (ID_ALIMENT,NOM,TYPE,ID_REGIME,IMAGE_URL,GLUCIDE,ENERGIE,GRAS,FIBRE,PROTEINE,SEL,GRAISSES_SATUREES,SUCRE) VALUES (";
      }

      try {
        $query_second_part = "";
        foreach ($aliment_obj as $cle => $valeur) {
          if (is_string($valeur)) {
            $query_second_part = $query_second_part . "'" . str_replace("'", '', $valeur) . "',";
          } else {
            if (is_null($valeur)) {
              $query_second_part = $query_second_part . "null,";
            } else {
              $query_second_part = $query_second_part . $valeur . ",";
            }
          }
        }

        $sql = $query_first_part . substr($query_second_part, 0, -1) . ")";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        http_response_code(201);
        echo json_encode(["message" => "Aliment créé avec succès."]);
      } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Erreur : " . $e->getMessage()]);
      }
    }
    break;

  
  case 'DELETE':
    // Analyser l'URL pour obtenir l'identifiant de l'aliment à supprimer
    parse_str($_SERVER['QUERY_STRING'], $query);
    if (isset($query['id_aliment'])) {
      $id = $query['id_aliment'];
  
      // Requête SQL pour supprimer l'aliment
      $sql = "DELETE FROM ALIMENT WHERE ID_ALIMENT = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  
      try {
        $stmt->execute();
        http_response_code(204); // 204 No Content pour indiquer que la ressource a été supprimée avec succès
      } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Erreur : " . $e->getMessage()]);
      }
    } else {
      http_response_code(400);
      echo json_encode(["message" => "L'identifiant de l'aliment à supprimer doit être spécifié dans l'URL."]);
    }
    break;
    

  case 'PUT':
    $data = json_decode(file_get_contents('php://input'));

    if (!isset($data->id_aliment)) {
      http_response_code(400);
      echo json_encode(["message" => "Le champ 'Code barre' est obligatoire."]);
    } else {
      // Assurez-vous que la requête inclut uniquement les champs que vous souhaitez mettre à jour
      $updates = [];

      if (isset($data->id_regime)) {
        $updates[] = "ID_REGIME = {$data->id_regime}";
      }

      if (isset($data->nom)) {
        $updates[] = "NOM = '{$data->nom}'";
      }

      if (isset($data->image_url)) {
        $updates[] = "IMAGE_URL = '{$data->image_url}'";
      }

      if (isset($data->type)) {
        $updates[] = "TYPE = {$data->type}";
      }

      if (isset($data->glucide)) {
        $updates[] = "GLUCIDE = {$data->glucide}";
      }

      if (isset($data->energie)) {
        $updates[] = "ENERGIE = {$data->energie}";
      }

      if (isset($data->gras)) {
        $updates[] = "GRAS = {$data->gras}";
      }

      if (isset($data->fibre)) {
        $updates[] = "FIBRE = {$data->fibre}";
      }

      if (isset($data->proteine)) {
        $updates[] = "PROTEINE = {$data->proteine}";
      }

      if (isset($data->sel)) {
        $updates[] = "SEL = {$data->sel}";
      }

      if (isset($data->graisses_saturees)) {
        $updates[] = "GRAISSES_SATUREES = {$data->graisses_saturees}";
      }

      if (isset($data->sucre)) {
        $updates[] = "SUCRE = {$data->sucre}";
      }

      if (isset($data->bicarbonate)) {
        $updates[] = "BICARBONATE = {$data->bicarbonate}";
      }

      if (isset($data->calcium)) {
        $updates[] = "CALCIUM = {$data->calcium}";
      }

      if (isset($data->chlorure)) {
        $updates[] = "CHLORURE = {$data->chlorure}";
      }

      if (isset($data->fluor)) {
        $updates[] = "FLUOR = {$data->fluor}";
      }

      if (isset($data->magnesium)) {
        $updates[] = "MAGNESIUM = {$data->magnesium}";
      }

      if (isset($data->nitrate)) {
        $updates[] = "NITRATE = {$data->nitrate}";
      }

      if (isset($data->potassium)) {
        $updates[] = "POTASSIUM = {$data->potassium}";
      }

      if (isset($data->silice)) {
        $updates[] = "SILICE = {$data->silice}";
      }

      if (isset($data->sodium)) {
        $updates[] = "SODIUM = {$data->sodium}";
      }

      if (isset($data->sulfate)) {
        $updates[] = "SULFATE = {$data->sulfate}";
      }

      if (!empty($updates)) {
        // Construire la requête SQL UPDATE avec les champs à mettre à jour
        $sql = "UPDATE ALIMENT SET " . implode(', ', $updates) . " WHERE ID_ALIMENT = {$data->id_aliment}";

        $request = $pdo->prepare($sql);

        if ($request->execute()) {
          http_response_code(200);
          echo json_encode(["message" => "Aliment modifié avec succès."]);
        } else {
          http_response_code(500);
          echo json_encode(["message" => "Erreur lors de la modification de l'aliment."]);
        }
      } else {
        // Aucune donnée à mettre à jour
        http_response_code(400);
        echo json_encode(["message" => "Aucune donnée à mettre à jour."]);
      }
    }
    break;
}

/*** close the database connection ***/
$pdo = null;
