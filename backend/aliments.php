<?php 
    require_once('init_pdo.php');
    header('Content-Type: application/json');


    switch ($_SERVER['REQUEST_METHOD']){

        case 'GET':
            $request = $pdo->prepare("SELECT * FROM ALIMENT WHERE TYPE = 0 OR TYPE = 1 ORDER BY ID_ALIMENT ASC");

            if(!$request->execute()){
                http_response_code(500);
                echo json_encode(["message" => "erreur lors de la lecture des aliments."]);
            }else{
                // retrieve data from database using fetch(PDO::FETCH_OBJ) and
                $reponss = $request->fetchAll(PDO::FETCH_OBJ);
            
                http_response_code(200);
                echo json_encode($reponss);
            }
            break;

                
    }
    
    /*** close the database connection ***/
    $pdo = null;
