<?php
// Démarrer la session
session_start();

// La langue par défaut est le français
if (isset($_POST['lang'])) {
  $_SESSION['lang'] = $_POST['lang'];
  header("Location: index.php");
} else {
  if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'fr';
  }
}

// La page par défaut est home
if (isset($_POST['page'])) {
  $_SESSION['page'] = $_POST['page'];
  header("Location: index.php");
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
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+EAN13+Text&family=Roboto&display=swap" rel="stylesheet">
  <meta charset='utf-8'>
  <script src="js/main.js" defer></script>
  <script src="js/ajout_plat.js" defer></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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