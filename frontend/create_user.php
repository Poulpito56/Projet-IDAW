<!DOCTYPE html>
<html>

<body>
  <script src="js/create_user.js" defer></script>
  CREER USER
  <form id="login_form" method="POST">
    <table>
      <tr>
        <th>Login :</th>
        <td><input id="login" type="text" name="login" pattern="[A-Za-z0-9_@!?. ]+" required></td>
      </tr>
      <tr>
        <th>Mot de passe :</th>
        <td><input id="password" type="password" name="password" pattern="[A-Za-z0-9_@!?. ]+" required></td>
      </tr>
      <tr>
        <th></th>
        <td id=" validate-button"><input type="submit" value="Se connecter..." /></td>
      </tr>
    </table>
  </form>
  <p id="message"></p>
</body>


</html>