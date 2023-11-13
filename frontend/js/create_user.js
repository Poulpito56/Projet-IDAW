const request = new XMLHttpRequest();

request.onreadystatechange = function () {
  if (request.readyState == 4) {
    if (request.status !== 201) {
      mess = document.getElementById('message');
      mess.innerHTML = JSON.parse(request.response).message
    } else {
      const data = { "login": document.getElementById('login').value };

      fetch('script_connexion.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
        .then(data => {
          window.location.href = "?page=journal";
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
  insertNewUser();
})

function insertNewUser() {
  var dietary_preferences = document.getElementById('dietary_preferences').value;
  var gender = document.getElementById('gender').value;
  var email = document.getElementById('email').value;
  var age = document.getElementById('age').value;
  var physical_activity = document.getElementById('physical_activity').value;
  var personne = {
    login: document.getElementById('login').value,
    password: document.getElementById('password').value,
    id_regime: (dietary_preferences !== "") ? dietary_preferences : null,
    sexe: (gender !== "") ? gender : null,
    mail: (email !== "") ? email : null,
    age: (age !== "") ? age : null,
    sport: (physical_activity !== "") ? physical_activity : null
  };
  request.open("POST", "http://localhost/Projet%20IDAW/backend/user.php", true);
  request.send(JSON.stringify(personne))
}