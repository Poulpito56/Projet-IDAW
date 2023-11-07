<div>
  <?php
  echo $tra->welcome . ' : ' . $_SESSION['utilisateur'] . '<br>';
  ?>
</div>

<form method="GET">
  <button type="submit" class="nav-button text-button">
    <input type="hidden" name="page" value="dish">
    <?php echo $tra->dish; ?>
  </button>
</form>
</div>