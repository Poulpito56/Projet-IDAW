<script src="js/create_user.js" defer></script>
<form id="login_form" method="POST">
  <table>
    <tr>
      <th><?php echo $tra->login; ?></th>
      <td><input id="login" type="text" name="login" pattern="[A-Za-z0-9_@!?. ]+" required></td>
    </tr>
    <tr>
      <th><?php echo $tra->password; ?></th>
      <td><input id="password" type="password" name="password" pattern="[A-Za-z0-9_@!?. ]+" required></td>
    </tr>
    <?php
    require_once('pages/personal_information_fields')
    ?>
    <tr>
      <th></th>
      <td id="validate-button"><input type="submit" value="<?php echo $tra->connect; ?>" /></td>
    </tr>
  </table>
</form>
<p id="message"></p>
<form method="POST">
  <button type="submit" class="nav-button">
    <input type="hidden" name="page" value="connexion">
    <img class="nav-img" src="imgs/logos/profil.png" alt="<?php echo $tra->connexion; ?>">
    <div class="tooltip"><?php echo $tra->connexion; ?></div>
  </button>
</form>