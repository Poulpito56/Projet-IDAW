<?php
// Démarrer la session
session_start();

// La langue par défaut est le français
if (isset($_GET['lang'])) {
  $_SESSION['lang'] = $_GET['lang'];
} else {
  if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'fr';
  }
}

// La page par défaut est home
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  if (($page !== 'connexion' && $page !== 'create_user') || !isset($_SESSION['utilisateur'])) {
    $_SESSION['page'] = $page;
  }
} else {
  if (!isset($_SESSION['page'])) {
    $_SESSION['page'] = 'home';
  }
}

// Vérifier si l'utilisateur est déjà connecté
if (!isset($_SESSION['utilisateur']) && $_SESSION['page'] !== 'create_user') {
  $_SESSION['page'] = 'connexion';
}

global $tra;
$tra = json_decode(file_get_contents('traductions/' . $_SESSION['lang'] . '.json'));
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/connexion.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/track_food.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+EAN13+Text&family=Roboto&display=swap" rel="stylesheet">
  <meta charset='utf-8'>
  <script src="js/main.js" defer></script>
  <!--<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>-->
  <script src="https://code.jquery.com/jquery-3.7.0.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.js" crossorigin="anonymous"></script>
  <link src="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">  
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
</head>

<body>
  <?php
  require_once('pages/header.php');
  echo '<div class="page">';
  require_once('pages/' . $_SESSION['page'] . '.php');
  echo '</div>';
  require_once('pages/footer.php');
  ?>
</body>

</html>