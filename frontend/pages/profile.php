<script src="js/modify_user.js" defer></script>
<div class="connection-container">
  <div class="connexion-content">
    <form class="custom-table" id="login_form" method="GET">
      <?php
      require_once('pages/personal_information_fields.php')
      ?>
      <button class="text-button" id="validate-button" type="submit"><?php echo $tra->validate; ?></button>
    </form>
  </div>
</div>
<p id="messageProfile"></p>
<script>
  var user = "<?php echo $_SESSION['utilisateur']; ?>";
  fetch(`http://localhost/Projet%20IDAW/backend/user.php?login=${user}`)
    .then(response => {
      if (!response.ok) {
        throw new Error(`Erreur lors de la requête : ${response.status} - ${response.statusText}`);
      }
      return response.json(); // Convertir la réponse en JSON
    })
    .then(data => {
      var personal_info = data[0];
      document.getElementById('dietary_preferences').value = personal_info.ID_REGIME;
      document.getElementById('gender').value = personal_info.SEXE;
      document.getElementById('email').value = (personal_info.MAIL !== 'null') ? personal_info.MAIL : "";
      document.getElementById('age').value = personal_info.AGE;
      document.getElementById('physical_activity').value = personal_info.SPORT;
    })
    .catch(error => {
      console.error('Erreur :', error);
    });
</script>