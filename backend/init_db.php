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

$nombre_de_valeurs = "100";

// URL de l'API open food facts
$api_url = "https://world.openfoodfacts.org/cgi/search.pl?action=process&sort_by=random&page_size=" . $nombre_de_valeurs . "&json=1&fields=nutriments,ingredients,id,product_name,image_url,categories_tags";

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

// Fonction qui crée un tableau simplifié d'un aliment
function createInsertValues($aliment)
{
  if (isset($aliment["id"]) && isset($aliment["product_name"])) {
    $aliment_obj = new stdClass();

    $aliment_obj->ID_ALIMENT = $aliment["id"];
    $aliment_obj->NOM = $aliment["product_name"];
    $aliment_obj->IMAGE_URL = isset($aliment["image_url"]) ? $aliment["image_url"] : NULL;
    if (isWater($aliment)) {
      $aliment_obj->TYPE = 0;
      $aliment_obj->BICARBONATE = isset($aliment["nutriments"]["bicarbonate_100g"]) ? $aliment["nutriments"]["bicarbonate_100g"] : -1;
      $aliment_obj->CALCIUM = isset($aliment["nutriments"]["calcium_100g"]) ? $aliment["nutriments"]["calcium_100g"] : -1;
      $aliment_obj->CHLORURE = isset($aliment["nutriments"]["chloride_100g"]) ? $aliment["nutriments"]["chloride_100g"] : -1;
      $aliment_obj->FLUOR = isset($aliment["nutriments"]["en-fluor_100g"]) ? $aliment["nutriments"]["en-fluor_100g"] : -1;
      $aliment_obj->MAGNESIUM = isset($aliment["nutriments"]["magnesium_100g"]) ? $aliment["nutriments"]["magnesium_100g"] : -1;
      $aliment_obj->NITRATE = isset($aliment["nutriments"]["nitrate_100g"]) ? $aliment["nutriments"]["nitrate_100g"] : -1;
      $aliment_obj->POTASSIUM = isset($aliment["nutriments"]["potassium_100g"]) ? $aliment["nutriments"]["potassium_100g"] : -1;
      $aliment_obj->SILICE = isset($aliment["nutriments"]["silica_100g"]) ? $aliment["nutriments"]["silica_100g"] : -1;
      $aliment_obj->SODIUM = isset($aliment["nutriments"]["sodium_100g"]) ? $aliment["nutriments"]["sodium_100g"] : -1;
      $aliment_obj->SULFATE = isset($aliment["nutriments"]["sulphate_100g"]) ? $aliment["nutriments"]["sulphate_100g"] : -1;
    } else {
      $aliment_obj->TYPE = 1;
      $aliment_obj->GLUCIDE = isset($aliment["nutriments"]["carbohydrates_100g"]) ? $aliment["nutriments"]["carbohydrates_100g"] : -1;
      $aliment_obj->ENERGIE = isset($aliment["nutriments"]["energy-kcal_100g"]) ? $aliment["nutriments"]["energy-kcal_100g"] : -1;
      $aliment_obj->GRAS = isset($aliment["nutriments"]["fat_100g"]) ? $aliment["nutriments"]["fat_100g"] : -1;
      $aliment_obj->FIBRE = isset($aliment["nutriments"]["fiber_100g"]) ? $aliment["nutriments"]["fiber_100g"] : -1;
      $aliment_obj->PROTEINE = isset($aliment["nutriments"]["proteins_100g"]) ? $aliment["nutriments"]["proteins_100g"] : -1;
      $aliment_obj->SEL = isset($aliment["nutriments"]["salt_100g"]) ? $aliment["nutriments"]["salt_100g"] : -1;
      $aliment_obj->GRAISSES_SATUREES = isset($aliment["nutriments"]["saturated-fat_100g"]) ? $aliment["nutriments"]["saturated-fat_100g"] : -1;
      $aliment_obj->SUCRE = isset($aliment["nutriments"]["sugars_100g"]) ? $aliment["nutriments"]["sugars_100g"] : -1;
    }
    return $aliment_obj;
  }
}

// Créer le string de la requête
$query_first_part_water = "INSERT INTO ALIMENT (ID_ALIMENT,NOM,IMAGE_URL,TYPE,BICARBONATE,CALCIUM,CHLORURE,FLUOR,MAGNESIUM,NITRATE,POTASSIUM,SILICE,SODIUM,SULFATE) VALUES (";
$query_first_part_other = "INSERT INTO ALIMENT (ID_ALIMENT,NOM,IMAGE_URL,TYPE,GLUCIDE,ENERGIE,GRAS,FIBRE,PROTEINE,SEL,GRAISSES_SATUREES,SUCRE) VALUES (";

foreach ($data as $aliment) {
  try {
    $query_second_part = "";
    $aliment_simplified = createInsertValues($aliment);
    if ($aliment_simplified !== null) {
      foreach ($aliment_simplified as $cle => $valeur) {
        if (is_string($valeur)) {
          $query_second_part = $query_second_part . "'" . str_replace("'", '', $valeur) . "',";
        } else {
          $query_second_part = $query_second_part . $valeur . ",";
        }
      }

      if (isWater($aliment)) { // Pas le même début de requête si c'est de l'eau
        $sql = $query_first_part_water . substr($query_second_part, 0, -1) . ")";
      } else {
        $sql = $query_first_part_other . substr($query_second_part, 0, -1) . ")";
      }
      // String de la requête construit

      // Préparer la requête
      $stmt = $pdo->prepare($sql);

      // Exécuter la requête
      $stmt->execute();
    }
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}
echo "Données insérées avec succès.<br>";


$pdo = NULL;
