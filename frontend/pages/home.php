<div>
  <?php
  echo $tra->welcome . ' : ' . $_SESSION['utilisateur'] . '<br>';
  ?>
</div>


<form method="GET">
  <button type="submit" class="text-button">
    <input type="hidden" name="page" value="track_food">
    <?php echo $tra->track_food; ?>
  </button>
</form>
</div>