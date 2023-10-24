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

$pdo = NULL;
