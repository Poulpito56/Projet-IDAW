<script src="js/modify_user.js" defer></script>
<form id="login_form" method="GET">
  <table>
    <?php
    require_once('pages/personal_information_fields.php')
    ?>
    <tr>
      <td id="validate-button"><input type="submit" value="<?php echo $tra->validate; ?>" /></td>
    </tr>
  </table>
</form>
<script>
  var user = "<?php echo $_SESSION['utilisateur']; ?>";
</script>