<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var user = <?php echo json_encode($_SESSION['utilisateur']); ?>;
</script>
<script src="js/journal.js" defer>
</script>
<div id="journal_container" class="journal-container">
  <canvas id="monGraphique" width="400" height="200"></canvas>
</div>
<p id="journal_error_message"></p>