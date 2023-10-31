<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+EAN13+Text&family=Roboto&display=swap" rel="stylesheet">
  <meta charset='utf-8'>
  <script src="js/main.js" defer></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
  <?php
  require_once('header.php');
  if (isset($_POST['page'])) {
    require_once($_POST['page'] . '.php');
  } else {
    require_once('accueil.php');
  }
  require_once('footer.php');
  ?>
</body>

</html>