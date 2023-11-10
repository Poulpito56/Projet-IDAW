<script>
  var user = <?php echo json_encode($_SESSION['utilisateur']); ?>;

  function displayModify() {
    var elements = document.getElementsByClassName('consomation-aliment-modifier');

    for (var i = 0; i < elements.length; i++) {
      elements[i].innerHTML = "<?php echo $tra->modify; ?>";
    }
  }
</script>
<script src="js/track_food.js" defer></script>
<div id="track_food_container">


</div>
<p id="track_food_error_message"></p>