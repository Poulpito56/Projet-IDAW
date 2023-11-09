<?php

require_once('init_pdo.php');
header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {

  case 'GET':

    if (!isset($_GET['login']) || !isset($_GET['date_consommation'])) {
      http_response_code(400);
      echo json_encode(["message" => "Les champs manquants."]);
    } else {
      $login = $_GET['login'];
      $date_consommation = $_GET['date_consommation'];

      $sql = "SELECT ID_CONSOMMATION,ID_ALIMENT,QUANTITE FROM CONSOMMER WHERE LOGIN = '" . $login . "' AND DATE_CONSOMMATION > '" . $date_consommation . "'";
      $request = $pdo->prepare($sql);

      try {
        $request->execute();
        http_response_code(200);
        echo json_encode($request->fetchAll(PDO::FETCH_OBJ));
      } catch (PDOException $e) {
        echo json_encode(["message" => $e->getMessage()]);
        http_response_code(500);
      }
    }
    break;

  case 'POST':
    $data = json_decode(file_get_contents('php://input'));


    if (!isset($data->login) || !isset($data->id_aliment) || !isset($data->date_consommation)) {
      http_response_code(400);
      echo json_encode(["message" => "Les champs manquants."]);
    } else {
      $quantite = isset($data->quantite) ? $data->quantite : "null";

      $sql = "INSERT INTO CONSOMMER (LOGIN,ID_ALIMENT,DATE_CONSOMMATION,QUANTITE)
              VALUES ('$data->login',$data->id_aliment,'$data->date_consommation',$quantite)";

      $request = $pdo->prepare($sql);

      try {
        $request->execute();
        http_response_code(201);
        echo json_encode(["message" => "Consommation créée avec succès."]);
      } catch (PDOException $e) {
        echo json_encode(["message" => $e->getMessage()]);
        http_response_code(500);
      }
    }
    break;

  case 'PUT':
    $data = json_decode(file_get_contents('php://input'));


    if (!isset($data->id_consommation) || !isset($data->id_aliment)) {
      http_response_code(400);
      echo json_encode(["message" => "Les champs manquants."]);
    } else {
      $quantite = isset($data->quantite) ? $data->quantite : "null";
      $date_consommation = isset($data->date_consommation) ? $data->date_consommation : "null";

      $sql = "UPDATE CONSOMMER
              SET ID_ALIMENT = $data->id_aliment, DATE_CONSOMMATION = $date_consommation, QUANTITE = $quantite
              WHERE ID_CONSOMMATION = $data->id_consommation";

      $request = $pdo->prepare($sql);

      try {
        $request->execute();
        http_response_code(200);
        echo json_encode(["message" => "Consommation modifée avec succès."]);
      } catch (PDOException $e) {
        echo json_encode(["message" => $e->getMessage()]);
        http_response_code(500);
      }
    }
    break;

  case 'DELETE':
    // Analyser l'URL pour obtenir l'identifiant de l'aliment à supprimer
    parse_str($_SERVER['QUERY_STRING'], $query);
    if (isset($query['id_consommation'])) {
      $id = $query['id_consommation'];

      // Requête SQL pour supprimer la consommation
      $sql = "DELETE FROM CONSOMMER WHERE ID_CONSOMMATION = :id";
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
      echo json_encode(["message" => "L'identifiant de la consommation à supprimer doit être spécifié dans l'URL."]);
    }
    break;
}

/*** close the database connection ***/
$pdo = null;
