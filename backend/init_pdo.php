<?php
  // Connexion à la base de données
  require_once('config.php');
  global $pdo;
  $connectionString = "mysql:host=" . _MYSQL_HOST;
  if (defined('_MYSQL_PORT'))
    $connectionString .= ";port=" . _MYSQL_PORT;
    $connectionString .= ";dbname=" . _MYSQL_DBNAME;
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $pdo = NULL;
  try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch (PDOException $erreur) {
    http_response_code(500);
    echo json_encode(["message" => "Erreur : ".$erreur->getMessage()]);
  }
?>