<script src="js/connexion.js" defer></script>
<div class="connection-container">
  <div class="connexion-content">
    <form class="custom-table" id="login_form" method="GET">
      <div class="custom-table-field">
        <div class="field-name"><?php echo $tra->login; ?></div>
        <input class="text-input" id="login" type="text" name="login" value="admin" pattern="[A-Za-z0-9_@!?. ]+" required>
      </div>
      <div class="custom-table-field">
        <div class="field-name"><?php echo $tra->password; ?></div>
        <input class="text-input" id="password" type="password" name="password" value="admin_mdpcomplike" pattern="[A-Za-z0-9_@!?. ]+" required>
      </div>
      <div class="">
        <button id="validate-button" class="text-button" type="submit"><?php echo $tra->connect; ?></button>
      </div>
    </form>
    <p id="message"></p>
    <form method="GET">
      <button type="submit" class="text-button">
        <input type="hidden" name="page" value="create_user">
        <?php echo $tra->create_user; ?>
      </button>
    </form>
  </div>
</div>