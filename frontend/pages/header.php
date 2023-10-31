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
  <img class="logo-site" src="imgs/logos/i_manger_mieux.png" alt="logo_site">
  <div class="navbar">
    <form>
      <button type="submit" class="nav-button">
        <img class="nav-img" src="imgs/logos/home.png" alt="home">
        <div class="tooltip">Accueil</div>
      </button>
    </form>
    <form method="POST">
      <button type="submit" class="nav-button">
        <input type="hidden" name="page" value="journal">
        <img class="nav-img" src="imgs/logos/journal.png" alt="journal">
        <div class="tooltip">Journal</div>
      </button>
    </form>
    <form method="POST">
      <button type="submit" class="nav-button">
        <input type="hidden" name="page" value="profil">
        <img class="nav-img" src="imgs/logos/profil.png" alt="profil">
        <div class="tooltip">Profil</div>
      </button>
    </form>
    <form method="POST">
      <button type="submit" class="nav-button">
        <input type="hidden" name="page" value="aliments">
        <img class="nav-img" src="imgs/logos/aliments.png" alt="aliments">
        <div class="tooltip">Aliments</div>
      </button>
    </form>
    <form method="POST">
      <button type="submit" class="nav-button">
        <input type="hidden" name="log_out">
        <img class="nav-img" src="imgs/logos/deconnection.png" alt="deconnection">
        <div class="tooltip">Déconnection</div>
      </button>
    </form>
  </div>
</header>