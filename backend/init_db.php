<?php
try {
  require_once('init_pdo.php');

  // Chemin vers le fichier SQL
  $sqlFile = 'sql/database.sql';

  // Lire le contenu du fichier SQL
  $sql = file_get_contents($sqlFile);

  // Exécution du code SQL
  $pdo->exec($sql);

  echo "Le fichier SQL a été exécuté avec succès.<br>";
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}

// URL de l'API open food facts
$api_url = "https://world.openfoodfacts.org/cgi/search.pl?action=process&sort_by=random&page_size=2&json=1&fields=nutriments,ingredients,id,product_name,image_url,categories_tags";

// Récupérer les données JSON depuis l'API
$response = file_get_contents($api_url);

// Vérifier si la requête a réussi
if ($response === FALSE) {
  die("Échec de la requête vers l'API");
}

// Analyser la réponse JSON en un tableau associatif
$data = json_decode($response, true)["products"];

// Vérifier si la réponse JSON est valide
if ($data === NULL) {
  die("Erreur lors de l'analyse de la réponse JSON");
}

function isWater($aliment)
{
  return in_array("en:waters", $aliment["categories_tags"]);
}


function createInsertValues($aliment)
{
  $aliment_obj = new stdClass();
  if (isWater($aliment)) {
    $aliment_obj->ID_ALIMENT = $aliment["id"];
    $aliment_obj->NOM = $aliment["product_name"];
    $aliment_obj->IMAGE_URL = $aliment["image_url"];
    $aliment_obj->TYPE = 0;
    $aliment_obj->BICARBONATE = $aliment["nutriments"]["bicarbonate_100g"];
    $aliment_obj->CALCIUM = $aliment["nutriments"]["calcium_100g"];
    $aliment_obj->CHLORURE = $aliment["nutriments"]["chloride_100g"];
    $aliment_obj->FLUOR = $aliment["nutriments"]["en-fluor_100g"];
    $aliment_obj->MAGNESIUM = $aliment["nutriments"]["magnesium_100g"];
    $aliment_obj->NITRATE = $aliment["nutriments"]["nitrate_100g"];
    $aliment_obj->POTASSIUM = $aliment["nutriments"]["potassium_100g"];
    $aliment_obj->SILICE = $aliment["nutriments"]["silica_100g"];
    $aliment_obj->SODIUM = $aliment["nutriments"]["sodium_100g"];
    $aliment_obj->SULFATE = $aliment["nutriments"]["sulphate_100g"];
  } else {
    $aliment_obj->ID_ALIMENT = $aliment["id"];
    $aliment_obj->NOM = $aliment["product_name"];
    $aliment_obj->IMAGE_URL = $aliment["image_url"];
    $aliment_obj->TYPE = 1;
    $aliment_obj->GLUCIDE = $aliment["nutriments"]["carbohydrates_100g"];
    $aliment_obj->ENERGIE = $aliment["nutriments"]["energy-kcal_100g"];
    $aliment_obj->GRAS = $aliment["nutriments"]["fat_100g"];
    $aliment_obj->FIBRE = $aliment["nutriments"]["fiber_100g"];
    $aliment_obj->PROTEINE = $aliment["nutriments"]["proteins_100g"];
    $aliment_obj->SEL = $aliment["nutriments"]["salt_100g"];
    $aliment_obj->GRAISSES_SATUREES = $aliment["nutriments"]["saturated-fat_100g"];
    $aliment_obj->SUCRE = $aliment["nutriments"]["sugars_100g"];
  }
  return $aliment_obj;
}

foreach ($data as $aliment) {
  try {


    // Créer le string de la requête
    $query_first_part = "INSERT INTO ALIMENT (";
    $query_second_part = ") VALUES (";
    foreach (createInsertValues($aliment) as $cle => $valeur) {
      $query_first_part = $query_first_part . strval($cle) . ",";
      $query_second_part = $query_second_part . strval($valeur) . ",";
    }
    $sql = substr($query_first_part, 0, -1) . substr($query_second_part, 0, -1) . ")";
    echo $sql;
    echo "<br>";

    // Préparer la requête
    $stmt = $pdo->prepare($sql);

    // Exécuter la requête
    $stmt->execute();
    echo "Données insérées avec succès.<br>";
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}


$pdo = NULL;
