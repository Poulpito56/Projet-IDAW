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
$api_url = "https://world.openfoodfacts.org/cgi/search.pl?action=process&sort_by=random&page_size=100&json=1&fields=nutriments,ingredients,id,product_name,image_url,categories_tags";

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

  $aliment_obj->ID_ALIMENT = $aliment["id"];
  $aliment_obj->NOM = $aliment["product_name"];
  if (isWater($aliment)) {
    $aliment_obj->TYPE = 0;
    $aliment_obj->BICARBONATE = isset($aliment["nutriments"]["bicarbonate_100g"]) ? $aliment["nutriments"]["bicarbonate_100g"] : null;
    $aliment_obj->CALCIUM = isset($aliment["nutriments"]["calcium_100g"]) ? $aliment["nutriments"]["calcium_100g"] : null;
    $aliment_obj->CHLORURE = isset($aliment["nutriments"]["chloride_100g"]) ? $aliment["nutriments"]["chloride_100g"] : null;
    $aliment_obj->FLUOR = isset($aliment["nutriments"]["en-fluor_100g"]) ? $aliment["nutriments"]["en-fluor_100g"] : null;
    $aliment_obj->MAGNESIUM = isset($aliment["nutriments"]["magnesium_100g"]) ? $aliment["nutriments"]["magnesium_100g"] : null;
    $aliment_obj->NITRATE = isset($aliment["nutriments"]["nitrate_100g"]) ? $aliment["nutriments"]["nitrate_100g"] : null;
    $aliment_obj->POTASSIUM = isset($aliment["nutriments"]["potassium_100g"]) ? $aliment["nutriments"]["potassium_100g"] : null;
    $aliment_obj->SILICE = isset($aliment["nutriments"]["silica_100g"]) ? $aliment["nutriments"]["silica_100g"] : null;
    $aliment_obj->SODIUM = isset($aliment["nutriments"]["sodium_100g"]) ? $aliment["nutriments"]["sodium_100g"] : null;
    $aliment_obj->SULFATE = isset($aliment["nutriments"]["sulphate_100g"]) ? $aliment["nutriments"]["sulphate_100g"] : null;
  } else {
    $aliment_obj->TYPE = 1;
    $aliment_obj->GLUCIDE = isset($aliment["nutriments"]["carbohydrates_100g"]) ? $aliment["nutriments"]["carbohydrates_100g"] : null;
    $aliment_obj->ENERGIE = isset($aliment["nutriments"]["energy-kcal_100g"]) ? $aliment["nutriments"]["energy-kcal_100g"] : null;
    $aliment_obj->GRAS = isset($aliment["nutriments"]["fat_100g"]) ? $aliment["nutriments"]["fat_100g"] : null;
    $aliment_obj->FIBRE = isset($aliment["nutriments"]["fiber_100g"]) ? $aliment["nutriments"]["fiber_100g"] : null;
    $aliment_obj->PROTEINE = isset($aliment["nutriments"]["proteins_100g"]) ? $aliment["nutriments"]["proteins_100g"] : null;
    $aliment_obj->SEL = isset($aliment["nutriments"]["salt_100g"]) ? $aliment["nutriments"]["salt_100g"] : null;
    $aliment_obj->GRAISSES_SATUREES = isset($aliment["nutriments"]["saturated-fat_100g"]) ? $aliment["nutriments"]["saturated-fat_100g"] : null;
    $aliment_obj->SUCRE = isset($aliment["nutriments"]["sugars_100g"]) ? $aliment["nutriments"]["sugars_100g"] : null;
  }
  return $aliment_obj;
}

foreach ($data as $aliment) {
  try {


    // Créer le string de la requête
    $query_first_part = "INSERT INTO ALIMENT (";
    $query_second_part = ") VALUES (";
    foreach (createInsertValues($aliment) as $cle => $valeur) {
      $query_first_part = $query_first_part . $cle . ",";
      if (is_string($valeur)) {
        $query_second_part = $query_second_part . "'" . $valeur . "',";
      } else {
        $query_second_part = $query_second_part . $valeur . ",";
      }
    }
    $sql = substr($query_first_part, 0, -1) . substr($query_second_part, 0, -1) . ")";
    // Préparer la requête
    $stmt = $pdo->prepare($sql);

    // Exécuter la requête
    $stmt->execute();
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}
echo "Données insérées avec succès.<br>";


$pdo = NULL;
