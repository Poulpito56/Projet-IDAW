<script src="js/main.js"></script>
<script src="js/ajout_plat.js" defer></script>
<script defer>
  var log = "<?php echo $_SESSION['utilisateur'] ?>";
  console.log(log);
afficherAlimentsType2Log(log); 
</script>



<table id="alimentT2Table" class="display nowrap" style="width:100%">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Code barre</th>
      <th scope="col">Energie</th>
      <th scope="col">image</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>


<input type="button" id="ajout_plat" value="<?php echo $tra->add_dish; ?>" class="text-button">





<p id="messageAjoutPlat"></p>