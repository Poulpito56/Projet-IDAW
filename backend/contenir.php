<?php
require_once('init_pdo.php');
header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {

  case 'GET':

    if (isset($_GET['id_aliment'])) {
      $id = $_GET['id_aliment'];
    } else {
      http_response_code(422);
      echo json_encode(["message" => "Paramètre manquant"]);

      /*** close the database connection ***/
      $pdo = null;

      exit;
    }

    $request = $pdo->prepare("SELECT * FROM CONTENIR WHERE ID_ALIMENT = '" . $id . "'");


    if ($request->execute()) {
      $reponse = $request->fetchAll(PDO::FETCH_OBJ);
      http_response_code(200);
      echo json_encode($reponse);
    } else {
      http_response_code(500);
      echo json_encode(["message" => "Erreur lors de l'affichage de l'aliment."]);
    }

    break;

  case 'POST':
    $data = json_decode(file_get_contents('php://input'));


    if (!isset($data->id_aliment) || !isset($data->ali_id_aliment) || !isset($data->pourcentage)) {
      http_response_code(400);
      echo json_encode(["message" => "Les champs 'plat', 'aliment' et 'poucentage' sont obligatoires."]);
    } else {

      $aliment_obj = new stdClass();

      $aliment_obj->NOM = $data->nom;
      $aliment_obj->TYPE = "2";
      $aliment_obj->ID_REGIME = isset($data->id_regime) ? $data->id_regime : NULL;
      $aliment_obj->IMAGE_URL = isset($data->image_url) ? $data->image_url : NULL;
    
    $aliment_obj->GLUCIDE = isset($data->glucide) ? $data->glucide : NULL;
    $aliment_obj->ENERGIE = isset($data->energie) ? $data->energie : NULL;
    $aliment_obj->GRAS = isset($data->gras) ? $data->gras : NULL;
    $aliment_obj->FIBRE = isset($data->fibre) ? $data->fibre : NULL;
    $aliment_obj->PROTEINE = isset($data->proteine) ? $data->proteine : NULL;
    $aliment_obj->SEL = isset($data->sel) ? $data->sel : NULL;
    $aliment_obj->GRAISSES_SATUREES = isset($data->graisses_saturees) ? $data->graisses_saturees : NULL;
    $aliment_obj->SUCRE = isset($data->sucre) ? $data->sucre : NULL;

    $query_first_part = "INSERT INTO ALIMENT (NOM,TYPE,ID_REGIME,IMAGE_URL,GLUCIDE,ENERGIE,GRAS,FIBRE,PROTEINE,SEL,GRAISSES_SATUREES,SUCRE) VALUES (";
    

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
        if ($stmt->execute()) {
          http_response_code(204); // 204 No Content pour indiquer que la ressource a été supprimée avec succès
        } else {
          http_response_code(500);
          echo json_encode(["message" => "Erreur lors de la suppression du plat {$id}."]);
        }
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
        $updates[] = "NOM = {$data->nom}";
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
