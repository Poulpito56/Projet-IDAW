<script>
  var user = <?php echo json_encode($_SESSION['utilisateur']); ?>;

  function displayModify() {
    var elements = document.getElementsByClassName('consomation-aliment-modifier');

    for (var i = 0; i < elements.length; i++) {
      elements[i].innerHTML = "<?php echo $tra->modify; ?>";
    }
  }

  function displayValidate() {
    var elements = document.getElementsByClassName('consomation-aliment-valider');

    for (var i = 0; i < elements.length; i++) {
      elements[i].innerHTML = "<?php echo $tra->validate; ?>";
    }
  }

  function displayDelete() {
    var elements = document.getElementsByClassName('consomation-aliment-supprimer');

    for (var i = 0; i < elements.length; i++) {
      elements[i].innerHTML = "<?php echo $tra->delete; ?>";
    }
  }
</script>
<script src="js/track_food.js" defer></script>
<div class="consomation-aliment-row">
  <div class="track-food-field-name"><?php echo $tra->name; ?></div>
  <div class="track-food-field-name"><?php echo $tra->quantity; ?></div>
  <div class="track-food-field-name"><?php echo $tra->date; ?></div>
  <div class="empty-div"></div>
</div>
<div id="track_food_container" class="track-food-container">


</div>
<p id="track_food_error_message"></p>