<div>
  <?php
  echo $tra->welcome . ' : ' . $_SESSION['utilisateur'] . '<br>';
  ?>
</div>

<form method="POST">
      <button type="submit" class="nav-button text-button">
        <input type="hidden" name="page" value="plat">
        <?php echo $tra->plat; ?>
      </button>
    </form>
