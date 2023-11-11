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

    $request = $pdo->prepare("SELECT * FROM ALIMENT WHERE ID_ALIMENT IN (SELECT ALI_ID_ALIMENT FROM CONTENIR WHERE ID_ALIMENT = '" . $id . "')");


    if ($request->execute()) {
      $reponse = $request->fetchAll(PDO::FETCH_OBJ);
      http_response_code(200);
      echo json_encode($reponse);
    } else {
      http_response_code(500);
      echo json_encode(["message" => "Erreur lors de l'affichage des aliments."]);
    }

    break;

  case 'POST':
    $data = json_decode(file_get_contents('php://input'));


    if (!isset($data->id_aliment) || !isset($data->ali_id_aliment) || !isset($data->poids)) {
      http_response_code(400);
      echo json_encode(["message" => "Les champs 'plat', 'aliment' et 'poids' sont obligatoires."]);
    } else {

      $plat_obj = new stdClass();

      $id = $data->id_aliment;
      $ali_id = $data->ali_id_aliment;
      $poids = $data->poids;

      $sql = "INSERT INTO CONTENIR (ID_ALIMENT, ALI_ID_ALIMENT, POIDS) VALUES ('" . $id . "', '" . $ali_id . "', '" . $poids . "')";
    

      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        http_response_code(201);
        echo json_encode(["message" => "Contenir créé avec succès."]);
      } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Erreur : " . $e->getMessage()]);
      }
    }
    break;

  
  case 'DELETE':
    // Analyser l'URL pour obtenir l'identifiant de l'aliment à supprimer
    parse_str($_SERVER['QUERY_STRING'], $query);
    if (isset($query['id_aliment']) && isset($query['ali_id_aliment'])) {
      $id = $query['id_aliment'];
      $ali_id = $query['ali_id_aliment'];
  
      // Requête SQL pour supprimer l'aliment
      $sql = "DELETE FROM CONTENIR WHERE ID_ALIMENT = :id AND ALI_ID_ALIMENT = :ali_id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->bindParam(':ali_id', $ali_id, PDO::PARAM_INT);
  
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
      echo json_encode(["message" => "Les identifiants du plat de l'aliment à supprimer doivent être spécifiés dans l'URL."]);
    }
    break;
    

  case 'PUT':
    $data = json_decode(file_get_contents('php://input'));

    if (!isset($data->id_aliment) || !isset($data->ali_id_aliment)) {
      http_response_code(400);
      echo json_encode(["message" => "Les identifiants du plat de l'aliment doivent être spécifiés."]);
    } else {
      // Assurez-vous que la requête inclut uniquement les champs que vous souhaitez mettre à jour
      $updates = [];

      if (isset($data->id_regime)) {
        $updates[] = "ID_REGIME = {$data->id_regime}";
      }



      if (!empty($updates)) {
        // Construire la requête SQL UPDATE avec les champs à mettre à jour
        $sql = "UPDATE CONTENIR SET " . implode(', ', $updates) . " WHERE ID_ALIMENT = {$data->id_aliment} AND ALI_ID_ALIMENT = {$data->ali_id_aliment}";

        $request = $pdo->prepare($sql);

        if ($request->execute()) {
          http_response_code(200);
          echo json_encode(["message" => "Contenir modifié avec succès."]);
        } else {
          http_response_code(500);
          echo json_encode(["message" => "Erreur lors de la modification du contenir."]);
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
