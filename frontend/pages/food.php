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
</script>
<script src="js/food.js" defer></script>
<script src="js/main.js" async></script>
<h2 id="pasDePlat"></h2>
<table id="alimentTable" class="display nowrap" style="width:100%">
  <thead>
    <tr>
      <th scope="col">Selectionner</th>
      <th scope="col">Nom</th>
      <th scope="col">Energie</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
