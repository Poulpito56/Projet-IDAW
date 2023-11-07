<?php

require_once('init_pdo.php');
header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {

  case 'GET':
    $data = json_decode(file_get_contents('php://input'));


    if (!isset($_GET['login'])) {
      http_response_code(400);
      echo json_encode(["message" => "Les champs manquants."]);
    } else {
      $login = $_GET['login'];

      $sql = "SELECT * FROM PERSONNE WHERE LOGIN = '" . $login . "'";
      $request = $pdo->prepare($sql);

      try {
        $request->execute();
        http_response_code(200);
        echo json_encode(["message" => "Personne créée avec succès."]);
      } catch (PDOException $e) {
        echo json_encode(["message" => $e->getMessage()]);
        http_response_code(500);
      }
    }
    break;

  case 'POST':
    $data = json_decode(file_get_contents('php://input'));


    if (!isset($data->login) || !isset($data->password)) {
      http_response_code(400);
      echo json_encode(["message" => "Les champs manquants."]);
    } else {
      $id_regime = isset($data->id_regime) ? $data->id_regime : "null";
      $mail = isset($data->mail) ? $data->mail : "null";
      $sexe = isset($data->sexe) ? $data->sexe : "null";
      $age = isset($data->age) ? $data->age : "null";
      $sport = isset($data->sport) ? $data->sport : "null";

      $sql = "INSERT INTO PERSONNE (LOGIN,ID_REGIME,PASSWORD,SEXE,ADMIN,MAIL,AGE,SPORT)
              VALUES ('$data->login',$id_regime,'$data->password',$sexe,false,'$mail',$age,$sport)";
      $request = $pdo->prepare($sql);

      try {
        $request->execute();
        http_response_code(201);
        echo json_encode(["message" => "Personne créée avec succès."]);
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
