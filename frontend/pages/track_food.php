<script>
  var user = <?php echo json_encode($_SESSION['utilisateur']); ?>;
</script>
<script src="js/track_food.js" defer></script>
<div id="track_food_container">


</div>
<p id="track_food_error_message"></p>