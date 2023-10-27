<?php

require_once('init_pdo.php');
header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {

  case 'POST':
    $data = json_decode(file_get_contents('php://input'));


    if (!isset($data->login) || !isset($data->password) || !isset($data->admin)) {
      http_response_code(400);
      echo json_encode(["message" => "Les champs manquants."]);
    } else {
      $id_regime = isset($data->id_regime) ? $data->id_regime : -1;
      $mail = isset($data->mail) ? $data->mail : "";
      $sexe = isset($data->sexe) ? $data->sexe : -1;
      $age = isset($data->age) ? $data->age : -1;
      $sport = isset($data->sport) ? $data->sport : -1;
      $request = $pdo->prepare("INSERT INTO PERSONNE (LOGIN, ID_REGIME, PASSWORD, SEXE, TYPE, ADMIN, MAIL, AGE, SPORT) VALUES ($data->login, $id_regime, $data->password, $sexe, $mail,$age, $sport)");

      if ($request->execute()) {
        http_response_code(201);
        echo json_encode(["message" => "Personne créé avec succès."]);
      } else {
        http_response_code(500);
        echo json_encode(["message" => "Erreur lors de la création de la personne."]);
      }
    }
    break;
}

/*** close the database connection ***/
$pdo = null;
