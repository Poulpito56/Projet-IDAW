<!DOCTYPE html>
<html>

<body>
  <script src="js/connexion.js" defer></script>
  CONNEXION
  <form id="login_form" method="POST" action="index.php">
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
        <td id="validate-button"><input type="submit" value="Se connecter..." /></td>
      </tr>
    </table>
  </form>
  <p id="message"></p>
  <a href="create_user.php">creer</a>

</body>

</html>