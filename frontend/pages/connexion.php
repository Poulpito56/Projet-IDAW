<script src="js/connexion.js" defer></script>
<form id="login_form" method="GET">
  <table>
    <tr>
      <th>Login :</th>
      <td><input id="login" type="text" name="login" value="admin" pattern="[A-Za-z0-9_@!?. ]+" required></td>
    </tr>
    <tr>
      <th>Mot de passe :</th>
      <td><input id="password" type="password" name="password" value="admin_mdpcomplike" pattern="[A-Za-z0-9_@!?. ]+" required></td>
    </tr>
    <tr>
      <th></th>
      <td id="validate-button"><input type="submit" value="<?php echo $tra->connect; ?>" /></td>
    </tr>
  </table>
</form>
<p id="message"></p>
<form method="GET">
  <button type="submit" class="nav-button">
    <input type="hidden" name="page" value="create_user">
    <img class="nav-img" src="imgs/logos/profil.png" alt="<?php echo $tra->create_user; ?>">
    <div class="tooltip"><?php echo $tra->create_user; ?></div>
  </button>
</form>