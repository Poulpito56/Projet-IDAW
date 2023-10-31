const request = new XMLHttpRequest();

request.onreadystatechange = function () {
  if (request.readyState == 4) {
    if (request.status !== 200) {
      mess = document.getElementById('message');
      mess.innerHTML = request.response;
    } else {
      // Si l'utilisateur existe bien, on crée une session pour rester connecté
      const data = { "login": document.getElementById('login').value };

      fetch('script_connexion.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
        .then(data => {
          window.location.href = 'index.php';
        })
        .catch(error => {
          console.error('Erreur :', error);
        });
    }
  }
};

var loginForm = document.getElementById('login_form');


loginForm.addEventListener("submit", function (event) {
  event.preventDefault();
  connexion();
})

function connexion() {
  var personne = {
    login: document.getElementById('login').value,
    password: document.getElementById('password').value
  };
  request.open("POST", "http://localhost/Projet%20IDAW/backend/user_connexion.php", true);
  request.send(JSON.stringify(personne))
}