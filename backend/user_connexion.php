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

      $sql = "SELECT * FROM PERSONNE WHERE LOGIN = '$data->login' AND PASSWORD = '$data->password'";
      $request = $pdo->prepare($sql);

      try {
        $request->execute();
        $reponse = $request->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($reponse);
        if ($reponse != null) {
          http_response_code(200);
          echo json_encode(["message" => "Connexion validée"]);
        } else {
          http_response_code(401);
          echo json_encode(["message" => "Identifiants inconnus"]);
        }
      } catch (PDOException $e) {
        echo json_encode(["message" => $e->getMessage()]);
        http_response_code(500);
      }
    }
    break;
}

/*** close the database connection ***/
$pdo = null;
