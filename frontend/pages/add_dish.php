<script src="js/main.js" defer></script>
<script src="js/ajout_plat.js"></script>
<form id="nouvPlatForm" method="PUT">
  <div class="custom-table-field">
    <h2 class="field-name"><?php echo ($tra->titleDish) . " :"; ?></h2>
    <input class="text-input" type="text" id="titreNouvPlat" pattern="[A-Za-z0-9 ]+" require>
  </div>
  <h3 class="field-name"><?php echo ($tra->food) . " :"; ?></h3>
  <table id="alimentTablePlat" class="display nowrap" style="width:100%">
    <thead>
      <tr>
        <th scope="col">Nom</th>
        <th scope="col">Code barre</th>
        <th scope="col">Energie</th>
        <th scope="col">Image</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>  

  <tr>
    <td id="validate-button-dish"><input class="text-button" type="button" value="<?php echo $tra->add_food; ?>" onclick="ajout_aliment()"/></td>
    <td id="validate-button-dish"><input class="text-button" type="submit" value="<?php echo $tra->validate; ?>" /></td>
  </tr>
</form>

<script>
  console.log('http://localhost/Projet%20IDAW/backend/aliment.php?type=3&login='+'<?php echo $_SESSION['utilisateur'] ?>');
  console.log('<?php echo $_SESSION['utilisateur'] ?>');

  fetch('http://localhost/Projet%20IDAW/backend/aliment.php?type=3&login='+'<?php echo $_SESSION['utilisateur'] ?>')
    .then(response => {
      if (!response.ok) {
        throw new Error(`Erreur lors de la requête : ${response.status} - ${response.statusText}`);
      }
      return response.json(); // Convertir la réponse en JSON
    })
    .then(data => {
      console.log(data);
      var plat_info = data[0];
      afficherAlimentsPlat(plat_info.ID_ALIMENT);
      document.getElementById('titreNouvPlat').value = (plat_info.NOM == "Plat n°") ? plat_info.NOM + plat_info.ID_ALIMENT : plat_info.NOM;
    })
    .catch(error => {
      console.error('Erreur :', error);
    });
</script>