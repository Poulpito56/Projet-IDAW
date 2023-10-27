<?php

require_once('init_pdo.php');
header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {

  case 'POST':
    $data = json_decode(file_get_contents('php://input'));


    if (!isset($data->login) || !isset($data->password)) {
      http_response_code(400);
      echo json_encode(["message" => "Les champs manquants."]);
    } else {
      $id_regime = isset($data->id_regime) ? $data->id_regime : "null";
      $mail = isset($data->mail) ? $data->mail : "rien";
      $sexe = isset($data->sexe) ? $data->sexe : -1;
      $age = isset($data->age) ? $data->age : -1;
      $sport = isset($data->sport) ? $data->sport : -1;

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
}

/*** close the database connection ***/
$pdo = null;
