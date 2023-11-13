<script src="js/main.js" defer></script>
<script src="js/ajout_plat.js"></script>
<div class="custom-table-field">
  <h2 class="field-name"><?php echo ($tra->titleDish) . " :"; ?></h2>
  <input class="text-input" type="text" id="titreNouvPlat" pattern="[A-Za-z0-9 ]">
  <input type="hidden" id="idNouvPlat">
</div>
<h3 class="field-name"><?php echo ($tra->food) . " :"; ?></h3>
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

<div class="custom-table-field">
  <div class="field-name"><?php echo $tra->dietary_preferences; ?></div>
  <select class="text-input" id='regime-alim-nouv-plat'>
    <option value="1"><?php echo $tra->omnivore; ?></option>
    <option value="2"><?php echo $tra->pescetarian; ?></option>
    <option value="3"><?php echo $tra->vegetarian; ?></option>
    <option value="4"><?php echo $tra->vegan; ?></option>
  </select>
</div>

<tr>
  <td id="validate-button-dish"><input class="text-button" type="button" value="<?php echo $tra->add_food; ?>" onclick="ajout_aliment()"/></td>
  <td id="validate-button-dish"><input class="text-button" type="button" value="<?php echo $tra->validate; ?>" onclick="validerNouvPlat()"/></td>
</tr>

<script>

  fetch('http://localhost/Projet%20IDAW/backend/aliment.php?type=3&login='+'<?php echo $_SESSION['utilisateur'] ?>')
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
      document.getElementById('regime-alim-nouv-plat').value = (isset(plat_info.ID_REGIME)) ? plat_info.ID_REGIME : 1;
    })
    .catch(error => {
      console.error('Erreur :', error);
    });
</script>