<!DOCTYPE html>
<html>
<script src="js/create_user.js" defer></script>
<form id="login_form" method="POST">
  <table>
    <tr>
      <th>Login :</th>
      <td><input id="login" type="text" name="login"></td>
    </tr>
    <tr>
      <th>Mot de passe :</th>
      <td><input id="password" type="password" name="password"></td>
    </tr>
    <tr>
      <th></th>
      <td id="validate-button"><input type="submit" value="Se connecter..." /></td>
    </tr>
  </table>
  <p id="message"></p>
</form>

</html>