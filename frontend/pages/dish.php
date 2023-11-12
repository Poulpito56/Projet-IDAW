<script>
  function displayAddDish() {
    var elements = document.getElementsByClassName('consume-dish-button');

    for (var i = 0; i < elements.length; i++) {
      elements[i].innerHTML = "<?php echo $tra->add; ?>";
    }
  }

  function displayConsumedDish(id_aliment) {
    btn = document.getElementById(`consume-button-${id_aliment}`);
    btn.innerHTML = "<?php echo $tra->added; ?>"
  }
</script>
<script src="js/main.js"></script>
<script>
  var log = "<?php echo $_SESSION['utilisateur'] ?>";
  afficherAlimentsType2Log(log);
</script>
<script src="js/plat.js" defer></script>



<table id="alimentT2Table" class="display nowrap" style="width:100%">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Nom</th>
      <th scope="col">Energie</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>


<input type="button" id="ajout_plat" value="<?php echo $tra->add_dish; ?>" class="text-button" onclick="verifType3Log('<?php echo $_SESSION['utilisateur'] ?>')">





<p id="messageAjoutPlat"></p>