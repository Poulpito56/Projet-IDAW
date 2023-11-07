<div>
  <?php
  echo $tra->welcome . ' : ' . $_SESSION['utilisateur'] . '<br>';
  ?>
</div>

<form method="POST">
      <button type="submit" class="nav-button">
        <input type="hidden" name="page" value="ajout_plat">
        <img class="nav-img" src="imgs/logos/aliments.png" alt="<?php echo $tra->food; ?>">
        <div class="tooltip"><?php echo $tra->food; ?></div>
      </button>
    </form>

    <form method="POST">
      <button type="submit" class="nav-button">
        <input type="hidden" name="page" value="food">
        <img class="nav-img" src="imgs/logos/aliments.png" alt="<?php echo $tra->food; ?>">
        <div class="tooltip"><?php echo $tra->food; ?></div>
      </button>
    </form>