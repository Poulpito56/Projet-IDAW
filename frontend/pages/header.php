<?php
if (isset($_POST['log_out'])) {
  session_start();
  session_unset();
  session_destroy();
  header('Location: connexion.php');
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
  <div class="navbar">
    <form method="POST">
      <button type="submit" class="nav-button">
        <input type="hidden" name="page" value="home">
        <img class="nav-img" src="imgs/logos/home.png" alt="<?php echo $tra->home; ?>">
        <div class="tooltip"><?php echo $tra->home; ?></div>
      </button>
    </form>
    <form method="POST">
      <button type="submit" class="nav-button">
        <input type="hidden" name="page" value="journal">
        <img class="nav-img" src="imgs/logos/journal.png" alt="<?php echo $tra->journal; ?>">
        <div class="tooltip"><?php echo $tra->journal; ?></div>
      </button>
    </form>
    <form method="POST">
      <button type="submit" class="nav-button">
        <input type="hidden" name="page" value="profile">
        <img class="nav-img" src="imgs/logos/profil.png" alt="<?php echo $tra->profile; ?>">
        <div class="tooltip"><?php echo $tra->profile; ?></div>
      </button>
    </form>
    <form method="POST">
      <button type="submit" class="nav-button">
        <input type="hidden" name="page" value="food">
        <img class="nav-img" src="imgs/logos/aliments.png" alt="<?php echo $tra->food; ?>">
        <div class="tooltip"><?php echo $tra->food; ?></div>
      </button>
    </form>
    <form method="POST">
      <button type="submit" class="nav-button">
        <input type="hidden" name="log_out">
        <img class="nav-img" src="imgs/logos/deconnection.png" alt="<?php echo $tra->log_out; ?>">
        <div class="tooltip"><?php echo $tra->log_out; ?></div>
      </button>
    </form>
  </div>
</header>