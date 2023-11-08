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

      $sql = "SELECT ID_ALIMENT FROM CONSOMMER WHERE LOGIN = '" . $login . "' AND DATE_CONSOMMATION = '" . $date_consommation . "'";
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


    if (!isset($data->login) || !isset($data->$id_aliment) || !isset($data->date_consommation)) {
      http_response_code(400);
      echo json_encode(["message" => "Les champs manquants."]);
    } else {
      $quantite = isset($data->quantite) ? $data->quantite : "null";

      $sql = "INSERT INTO CONSOMMER (LOGIN,ID_ALIMENT,DATE_CONSOMMATION,QUANTITE)
              VALUES ('$data->login',$data->$id_aliment,'$data->date_consommation',$quantite)";

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


    if (!isset($data->login)) {
      http_response_code(400);
      echo json_encode(["message" => "Login missing"]);
    } else {
      $id_regime = isset($data->id_regime) ? $data->id_regime : "null";
      $mail = isset($data->mail) ? $data->mail : "null";
      $sexe = isset($data->sexe) ? $data->sexe : "null";
      $age = isset($data->age) ? $data->age : "null";
      $sport = isset($data->sport) ? $data->sport : "null";

      $sql = "UPDATE PERSONNE
              SET ID_REGIME = $id_regime, SEXE = $sexe, MAIL = '$mail', AGE = $age, SPORT = $sport
              WHERE LOGIN = '$data->login'";
      $request = $pdo->prepare($sql);

      try {
        $request->execute();
        http_response_code(200);
        echo json_encode(["message" => "Personne modifiée avec succès."]);
      } catch (PDOException $e) {
        echo json_encode(["message" => $e->getMessage()]);
        http_response_code(500);
      }
    }
    break;
}

/*** close the database connection ***/
$pdo = null;
