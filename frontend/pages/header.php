<?php
if (isset($_POST['log_out'])) {
  unset($_SESSION['utilisateur']);
  header('Location: index.php');
  exit();
}
?>

<header>
  <div class="page-logo-title">
    <img class="logo-site" src="imgs/logos/i_manger_mieux.png" alt="logo_site">
    <div class="page-title">
      <?php
      $page = $_SESSION['page'];
      echo $tra->$page;
      ?>
    </div>
  </div>
  <?php
  if (isset($_SESSION['utilisateur'])) {
    require_once('navbar.php');
  }
  ?>
</header>