<div class="navbar">
  <?php
  if ($_SESSION['page'] === 'track_food') {
    require_once('pages/date_selection.php');
  }
  ?>
  <form method="GET">
    <button type="submit" class="nav-button">
      <input type="hidden" name="page" value="home">
      <img class="nav-img" src="imgs/logos/home.png" alt="<?php echo $tra->home; ?>">
      <div class="tooltip"><?php echo $tra->home; ?></div>
    </button>
  </form>
  <form method="GET">
    <button type="submit" class="nav-button">
      <input type="hidden" name="page" value="journal">
      <img class="nav-img" src="imgs/logos/journal.png" alt="<?php echo $tra->journal; ?>">
      <div class="tooltip"><?php echo $tra->journal; ?></div>
    </button>
  </form>
  <form method="GET">
    <button type="submit" class="nav-button">
      <input type="hidden" name="page" value="profile">
      <img class="nav-img" src="imgs/logos/profil.png" alt="<?php echo $tra->profile; ?>">
      <div class="tooltip"><?php echo $tra->profile; ?></div>
    </button>
  </form>
  <form method="GET">
    <button type="submit" class="nav-button">
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