<?php
try {
  require_once('init_pdo.php');

  // Chemin vers le fichier SQL
  $sqlFile = 'sql/database.sql';

  // Lire le contenu du fichier SQL
  $sql = file_get_contents($sqlFile);

  // Exécution du code SQL
  $pdo->exec($sql);

  echo "Le fichier SQL a été exécuté avec succès.";
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}

// URL de l'API open food facts
$url = 'https://world.openfoodfacts.org/cgi/search.pl?action=process&sort_by=random&page_size=2&json=1&fields=nutriments,ingredients,id,product_name,image_url,categories_tags';

// Utilisation de cURL pour effectuer la requête GET
$curl = curl_init($url);

// Configuration de cURL
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Exécution de la requête
$response = curl_exec($curl);

// Vérification des erreurs
if ($response === false) {
  echo 'Erreur de cURL : ' . curl_error($curl);
  die();
}

// Fermeture de la session cURL
curl_close($curl);

// Conversion de la réponse JSON en un tableau associatif PHP
$data = json_decode($response, true);

if ($data === null) {
  echo 'Erreur de conversion en JSON : ' . json_last_error_msg();
} else {
  // Maintenant, "$data" contient le tableau JSON récupéré depuis l'API
  print_r($data);

  // Vous pouvez traiter les données ici
}

$pdo = NULL;
