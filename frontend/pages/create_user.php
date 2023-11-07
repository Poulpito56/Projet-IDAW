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
    <tr>
      <th><?php echo $tra->dietary_preferences; ?></th>
      <td>
        <input type="radio" id="omnivore" name="dietary_preferences" value="1" checked>
        <label for="omnivore"><?php echo $tra->omnivore; ?></label>

        <input type="radio" id="pescetarian" name="dietary_preferences" value="2">
        <label for="pescetarian"><?php echo $tra->pescetarian; ?></label>

        <input type="radio" id="vegetarian" name="dietary_preferences" value="3">
        <label for="vegetarian"><?php echo $tra->vegetarian; ?></label>

        <input type="radio" id="vegan" name="dietary_preferences" value="4">
        <label for="vegan"><?php echo $tra->vegan; ?></label>
      </td>
    </tr>
    <tr>
      <th><?php echo $tra->gender; ?></th>
      <td>
        <input type="radio" id="unspecified" name="gender" value="1" checked>
        <label for="unspecified"><?php echo $tra->unspecified; ?></label>

        <input type="radio" id="female" name="gender" value="2">
        <label for="female"><?php echo $tra->female; ?></label>

        <input type="radio" id="male" name="gender" value="3">
        <label for="male"><?php echo $tra->male; ?></label>
      </td>
    </tr>
    <tr>
      <th><?php echo $tra->email; ?></th>
      <td><input id="email" name="email" pattern="[A-Za-z0-9_@!?. ]+"></td>
    </tr>
    <tr>
      <th><?php echo $tra->age; ?></th>
      <td><input type="number" id="age" name="age" min="1" max="200"></td>
    </tr>
    <tr>
      <th><?php echo $tra->physical_activity; ?></th>
      <td><input type="number" id="physical_activity" name="physical_activity" min="1" max="10"></td>
    </tr>
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