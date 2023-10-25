<?php 
    require_once('init_pdo.php');
    header('Content-Type: application/json');


    switch ($_SERVER['REQUEST_METHOD']){

        case 'GET':
            $request = $pdo->prepare("SELECT * FROM ALIMENT ORDER BY ID_ALIMENT ASC");

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
                    $request = $pdo->prepare("INSERT INTO ALIMENT (ID_ALIMENT, ID_REGIME, NOM, IMAGE_URL, TYPE, BICARBONATE, CALCIUM, CHLORURE, FLUOR, MAGNESIUM, NITRATE, POTASSIUM, SILICE, SODIUM, SULFATE)
                        VALUES ({$data->id_aliment}, {$data->id_regime}, '{$data->nom}', '{$data->image_url}', {$data->type}, 
                        {$data->bicarbonate}, {$data->calcium}, {$data->chlorure}, {$data->fluor}, {$data->magnesium}, {$data->nitrate}, {$data->potassium}, {$data->silice}, {$data->sodium}, {$data->sulfate})
                    ");
                } else {
                    $request = $pdo->prepare("INSERT INTO ALIMENT (ID_ALIMENT, ID_REGIME, NOM, IMAGE_URL, TYPE, GLUCIDE, ENERGIE, GRAS, FIBRE, PROTEINE, SEL, GRAISSES_SATUREES, SUCRE) 
                        VALUES ({$data->id_aliment}, {$data->id_regime}, '{$data->nom}', '{$data->image_url}', {$data->type}, 
                        {$data->glucide}), {$data->energie}), {$data->gras}), {$data->fibre}), {$data->proteine}), {$data->sel}), {$data->graisses_saturees}), {$data->sucre})
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
                $request = $pdo->prepare("DELETE FROM ALIMENT WHERE ID_ALIMENT = {$data->id_aliment}");
            
                if(!$request->execute()){
                    http_response_code(500);
                    echo json_encode(["message" => "Erreur lors de la suppression de l'aliment."]);
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
                    $updates[] = "ID_REGIME = {$data->id_regime}";
                }
                
                if (isset($data->nom)) {
                    $updates[] = "NOM = '{$data->nom}'";
                }
                
                if (isset($data->image_url)) {
                    $updates[] = "IMAGE_URL = '{$data->image_url}'";
                }
                
                if (isset($data->type)) {
                    $updates[] = "TYPE = {$data->type}";
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
                
                if (isset($data->bicarbonate)) {
                    $updates[] = "BICARBONATE = {$data->bicarbonate}";
                }
                
                if (isset($data->calcium)) {
                    $updates[] = "CALCIUM = {$data->calcium}";
                }
                
                if (isset($data->chlorure)) {
                    $updates[] = "CHLORURE = {$data->chlorure}";
                }
                
                if (isset($data->fluor)) {
                    $updates[] = "FLUOR = {$data->fluor}";
                }
                
                if (isset($data->magnesium)) {
                    $updates[] = "MAGNESIUM = {$data->magnesium}";
                }
                
                if (isset($data->nitrate)) {
                    $updates[] = "NITRATE = {$data->nitrate}";
                }
                
                if (isset($data->potassium)) {
                    $updates[] = "POTASSIUM = {$data->potassium}";
                }
                
                if (isset($data->silice)) {
                    $updates[] = "SILICE = {$data->silice}";
                }
                
                if (isset($data->sodium)) {
                    $updates[] = "SODIUM = {$data->sodium}";
                }
                
                if (isset($data->sulfate)) {
                    $updates[] = "SULFATE = {$data->sulfate}";
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
?>