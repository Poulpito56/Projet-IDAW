<script src="js/create_user.js" defer></script>
<script>
  var tooltip = <?php echo json_encode($tra); ?>;
</script>
<script src="js/password.js" defer></script>
<div class="connection-container">
  <div class="connexion-content">
    <form class="custom-table" id="login_form" method="GET">

      <div class="custom-table-field">
        <div class="field-name"><?php echo $tra->login; ?></div>
        <input class="text-input" id="login" type="text" name="login" pattern="[A-Za-z0-9_@!?. ]+" required>
      </div>
      <div class="custom-table-field">
        <div class="field-name"><?php echo $tra->password; ?></div>
        <input class="text-input" id="password" type="password" name="password" pattern="[A-Za-z0-9_@!?. ]+" required>
        <button type="button" id="show_hide_password" class="icon-button">
          <img class="icon" src="imgs/logos/password_hidden.png" alt="<?php echo $tra->show_pasword; ?>">
          <div class="tooltip"><?php echo $tra->show_pasword; ?></div>
        </button>
      </div>
      <?php
      require_once('pages/personal_information_fields.php')
      ?>
      <button class="text-button" id="validate-button" type="submit"><?php echo $tra->connect; ?></button>

    </form>
    <p id="message"></p>
    <form method="GET">
      <button type="submit" class="text-button">
        <input type="hidden" name="page" value="connexion">
        <?php echo $tra->back; ?>
      </button>
    </form>
  </div>
</div>