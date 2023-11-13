<div class="navbar">
  <?php
  if ($_SESSION['page'] === 'track_food' || $_SESSION['page'] === 'journal') {
    require_once('pages/date_selection.php');
  }
  ?>
  <form method="GET">
    <button id="navbar_button_page_journal" type="submit" class="nav-button">
      <input type="hidden" name="page" value="journal">
      <img class="nav-img" src="imgs/logos/journal.png" alt="<?php echo $tra->journal; ?>">
      <div class="tooltip"><?php echo $tra->journal; ?></div>
    </button>
  </form>
  <form method="GET">
    <button id="navbar_button_page_track_food" type="submit" class="nav-button">
      <input type="hidden" name="page" value="track_food">
      <img class="nav-img" src="imgs/logos/track_food.png" alt="<?php echo $tra->track_food; ?>">
      <div class="tooltip"><?php echo $tra->track_food; ?></div>
    </button>
  </form>
  <form method="GET">
    <button id="navbar_button_page_profile" type="submit" class="nav-button">
      <input type="hidden" name="page" value="profile">
      <img class="nav-img" src="imgs/logos/profil.png" alt="<?php echo $tra->profile; ?>">
      <div class="tooltip"><?php echo $tra->profile; ?></div>
    </button>
  </form>
  <form method="GET">
    <button id="navbar_button_page_dish" type="submit" class="nav-button">
      <input type="hidden" name="page" value="dish">
      <img class="nav-img" src="imgs/logos/aliments.png" alt="<?php echo $tra->dish; ?>">
      <div class="tooltip"><?php echo $tra->dish; ?></div>
    </button>
  </form>
  <form method="GET">
    <button type="submit" class="nav-button">
      <input type="hidden" name="log_out">
      <img class="nav-img" src="imgs/logos/deconnection.png" alt="<?php echo $tra->log_out; ?>">
      <div class="tooltip"><?php echo $tra->log_out; ?></div>
    </button>
  </form>
</div>
<script>
  const actualPage = document.getElementById("navbar_button_page_<?php echo $_SESSION['page']; ?>");
  console.log(actualPage)

  // Vérifier si l'élément avec l'ID existe
  if (actualPage) {
    // Ajouter la classe à l'élément
    actualPage.classList.add("active-nav-button");
  }
</script>