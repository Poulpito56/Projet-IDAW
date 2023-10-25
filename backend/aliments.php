<?php 
    require_once('init_pdo.php');
    header('Content-Type: application/json');


    switch ($_SERVER['REQUEST_METHOD']){

        case 'GET':
            $request = $pdo->prepare("SELECT * FROM aliment ORDER BY id_aliment ASC");

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

        case 'POST':
            $data = json_decode(file_get_contents('php://input'));
            
            
            if (!isset($data->id_aliment) || !isset($data->nom) || !isset($data->type) || !isset($data->regime)) {
                http_response_code(400);
                echo json_encode(["message" => "Les champs 'Code barre', 'Nom', 'Type' et 'Régime alimentaire' sont obligatoires."]);
            } else {
                if($data -> type == 0){
                    $request = $pdo->prepare("INSERT INTO aliment (id_aliment, id_regime, nom, image_url, type, bicarbonate, calcium, chlorure, fluor, magnesium, nitrate, potassium, silice, sodium, sulfate)
                        VALUES ('{$data->id_aliment}', '{$data->id_regime}', '{$data->nom}', '{$data->image_url}', '{$data->type}', 
                        '{$data->bicarbonate}', '{$data->calcium}', '{$data->chlorure}', '{$data->fluor}', '{$data->magnesium}', '{$data->nitrate}', '{$data->potassium}', '{$data->silice}', '{$data->sodium}', '{$data->sulfate}')
                    ");
                } else {
                    $request = $pdo->prepare("INSERT INTO aliment (id_aliment, id_regime, nom, image_url, type, glucide, energie, gras, fibre, proteine, sel, graisses_saturees, sucre) 
                        VALUES ('{$data->id_aliment}', '{$data->id_regime}', '{$data->nom}', '{$data->image_url}', '{$data->type}', 
                        '{$data->glucide}'), '{$data->energie}'), '{$data->gras}'), '{$data->fibre}'), '{$data->proteine}'), '{$data->sel}'), '{$data->graisses_saturees}'), '{$data->sucre}')
                    ");

                }
                
                if($request->execute()){
                    http_response_code(201);
                    echo json_encode(["message" => "Aliment créé avec succès."]);
                }else{
                    http_response_code(500);
                    echo json_encode(["message" => "Erreur lors de la création de l'aliment."]);
                }
            }
            break;

        case 'DELETE':
            $data = json_decode(file_get_contents('php://input'));

            if (!isset($data->id_aliment)) {
                http_response_code(400);
                echo json_encode(["message" => "Le champ 'Code barre' est obligatoire."]);
            } else {
                $request = $pdo->prepare("DELETE FROM aliment WHERE id_aliment = {$data->id_aliment}");
            
                if(!$request->execute()){
                    http_response_code(500);
                    echo json_encode(["message" => "erreur lors de la suppression de l'aliment."]);
                }else{
                    // retrieve data from database using fetch(PDO::FETCH_OBJ) and
                    http_response_code(204);
                    echo json_encode(["message" => "Aliment créé avec succès."]);
                }
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
                    $updates[] = "id_regime = '{$data->id_regime}'";
                }
                
                if (isset($data->nom)) {
                    $updates[] = "nom = '{$data->nom}'";
                }
                
                if (isset($data->image_url)) {
                    $updates[] = "image_url = '{$data->image_url}'";
                }
                
                if (isset($data->type)) {
                    $updates[] = "type = '{$data->type}'";
                }
                
                if (isset($data->glucide)) {
                    $updates[] = "glucide = '{$data->glucide}'";
                }
                
                if (isset($data->energie)) {
                    $updates[] = "energie = '{$data->energie}'";
                }
                
                if (isset($data->gras)) {
                    $updates[] = "gras = '{$data->gras}'";
                }
                
                if (isset($data->fibre)) {
                    $updates[] = "fibre = '{$data->fibre}'";
                }
                
                if (isset($data->proteine)) {
                    $updates[] = "proteine = '{$data->proteine}'";
                }
                
                if (isset($data->sel)) {
                    $updates[] = "sel = '{$data->sel}'";
                }
                
                if (isset($data->graisses_saturees)) {
                    $updates[] = "graisses_saturees = '{$data->graisses_saturees}'";
                }
                
                if (isset($data->sucre)) {
                    $updates[] = "sucre = '{$data->sucre}'";
                }
                
                if (isset($data->bicarbonate)) {
                    $updates[] = "bicarbonate = '{$data->bicarbonate}'";
                }
                
                if (isset($data->calcium)) {
                    $updates[] = "calcium = '{$data->calcium}'";
                }
                
                if (isset($data->chlorure)) {
                    $updates[] = "chlorure = '{$data->chlorure}'";
                }
                
                if (isset($data->fluor)) {
                    $updates[] = "fluor = '{$data->fluor}'";
                }
                
                if (isset($data->magnesium)) {
                    $updates[] = "magnesium = '{$data->magnesium}'";
                }
                
                if (isset($data->nitrate)) {
                    $updates[] = "nitrate = '{$data->nitrate}'";
                }
                
                if (isset($data->nitrate)) {
                    $updates[] = "nitrate = '{$data->nitrate}'";
                }
                
                if (isset($data->potassium)) {
                    $updates[] = "potassium = '{$data->potassium}'";
                }
                
                if (isset($data->silice)) {
                    $updates[] = "silice = '{$data->silice}'";
                }
                
                if (isset($data->sodium)) {
                    $updates[] = "sodium = '{$data->sodium}'";
                }
                
                if (isset($data->sulfate)) {
                    $updates[] = "sulfate = '{$data->sulfate}'";
                }

                if (!empty($updates)) {
                    // Construire la requête SQL UPDATE avec les champs à mettre à jour
                    $sql = "UPDATE aliment SET " . implode(', ', $updates) . " WHERE id_aliment = {$data->id_aliment}";
                    
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
?>