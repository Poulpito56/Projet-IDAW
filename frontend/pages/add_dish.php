<script src="js/main.js" defer></script>
<script src="js/ajout_plat.js"></script>
<div class="add-dish-container">

  <div class="add-dish-field">
    <div class="add-dish-field-title"><?php echo ($tra->titleDish) . " :"; ?></div>
    <input class="text-input brown-border add-dish-input" type="text" id="titreNouvPlat" pattern="[A-Za-z0-9 ]">
    <input type="hidden" id="idNouvPlat">
  </div>

  <div class="add-dish-field">
    <div class="add-dish-field-title"><?php echo $tra->dietary_preferences . " : "; ?></div>
    <select class="text-input brown-border add-dish-input" id='regime-alim-nouv-plat'>
      <option value="1"><?php echo $tra->omnivore; ?></option>
      <option value="2"><?php echo $tra->pescetarian; ?></option>
      <option value="3"><?php echo $tra->vegetarian; ?></option>
      <option value="4"><?php echo $tra->vegan; ?></option>
    </select>
  </div>

  <div class="add-dish-aliment-list">
    <div class="add-dish-field-title"><?php echo ($tra->food) . " :"; ?></div>
    <table id="alimentTablePlat" class="display nowrap" style="width:100%">
      <thead>
        <tr>
          <th scope="col">Nom</th>
          <th scope="col">Energie</th>
          <th scope="col">Image</th>
          <th scope="col">Quantité</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <div>
      <button class="text-button" onclick="ajout_aliment()"><?php echo $tra->add_food; ?></button>
    </div>
  </div>

  <div class="bot-buttons">
    <button class="text-button" onclick="validerNouvPlat()"><?php echo $tra->validate; ?></button>
  </div>
</div>


<script>
  fetch('http://localhost/Projet%20IDAW/backend/aliment.php?type=3&login=' + '<?php echo $_SESSION['utilisateur'] ?>')
    .then(response => {
      if (!response.ok) {
        throw new Error(`Erreur lors de la requête : ${response.status} - ${response.statusText}`);
      }
      return response.json(); // Convertir la réponse en JSON
    })
    .then(data => {
      var plat_info = data[0];
      afficherAlimentsPlat(plat_info.ID_ALIMENT);
      document.getElementById('titreNouvPlat').value = (plat_info.NOM == "Plat n°") ? plat_info.NOM + plat_info.ID_ALIMENT : plat_info.NOM;
      document.getElementById('idNouvPlat').value = plat_info.ID_ALIMENT;
      document.getElementById('regime-alim-nouv-plat').value = plat_info.ID_REGIME;
    })
    .catch(error => {
      console.error('Erreur :', error);
    });
</script>