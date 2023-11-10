<script src="js/main.js"></script>
<script src="js/plat.js"></script>
<script defer>
  var log = "<?php echo $_SESSION['utilisateur'] ?>";
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


<input type="button" id="ajout_plat" value="<?php echo $tra->add_dish; ?>" class="text-button" onclick="verifType3Log('<?php echo $_SESSION['utilisateur'] ?>')">





<p id="messageAjoutPlat"></p>