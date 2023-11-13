<script>
  function displayAdd() {
    var elements = document.getElementsByClassName('add-food-to-dish-button');

    for (var i = 0; i < elements.length; i++) {
      elements[i].innerHTML = "<?php echo $tra->add; ?>";
    }
  }

  function displaySup() {
    var elements = document.getElementsByClassName('sup-food-to-dish-button');

    for (var i = 0; i < elements.length; i++) {
      elements[i].innerHTML = "<?php echo $tra->delete; ?>";
    }
  }

  function addToSup(idPlat) {
    fetch(`http://localhost/Projet%20IDAW/backend/contenir.php?id_aliment=${idPlat}`, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json'
        },
      })
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        // Parse the JSON content of the response
        return response.json();
      })
      .then(result => {
        for (const ali of result) {
          const idAli = ali.ID_ALIMENT
          but = document.getElementById('button-' + idAli);
          but.classList.remove('add-food-to-dish-button');
          but.classList.add('sup-food-to-dish-button');
          but.classList.add('red-background');
          but.setAttribute('onclick', `supprimerAliment(${idAli}, ${idPlat})`)
          but.innerHTML = "<?php echo $tra->delete; ?>";
        }
      })
      .catch(error => {
        mess = document.getElementById('messageFood');
        mess.innerHTML = error;
      })
  }
</script>
<script src="js/food.js" defer></script>
<script src="js/main.js" async></script>
<div class="food-container">
  <div class="add-dish-field-title" id="pasDePlat"><?php echo $tra->add_food; ?></div>
  <table id="alimentTable" class="display nowrap" style="width:100%">
    <thead>
      <tr>
        <th scope="col"><?php echo $tra->select; ?></th>
        <th scope="col"><?php echo $tra->name; ?></th>
        <th scope="col"><?php echo $tra->energy; ?></th>
        <th scope="col"><?php echo $tra->image; ?></th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>

  <form method="GET" class="bot-buttons">
    <button type="submit" class="text-button">
      <input type="hidden" name="page" value="add_dish">
      <?php echo $tra->validate; ?>
    </button>
  </form>

  <p id="messageFood"></p>
</div>