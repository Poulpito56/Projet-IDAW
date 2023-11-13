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
    btn.disabled = true;
    setTimeout(function() {
      btn.innerHTML = "<?php echo $tra->add; ?>";
      btn.disabled = false;
      displayAddDish();
    }, 300);
  }
</script>
<script src="js/main.js"></script>
<script>
  var log = "<?php echo $_SESSION['utilisateur'] ?>";
  afficherAlimentsType2Log(log);
</script>
<script src="js/plat.js" defer></script>

<div class="dish-container">
  <table id="alimentT2Table" class="display nowrap" style="width:100%">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col"><?php echo $tra->name; ?></th>
        <th scope="col"><?php echo $tra->energy; ?></th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>

  <div class="bot-buttons">
    <input type="button" id="ajout_plat" value="<?php echo $tra->add_dish; ?>" class="text-button" onclick="verifType3Log('<?php echo $_SESSION['utilisateur'] ?>')">
  </div>

  <p id="messageAjoutPlat"></p>
</div>