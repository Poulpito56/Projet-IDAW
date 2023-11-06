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
  insertNewUser();
})

function insertNewUser() {
  var dietary_preferences = document.querySelector('input[name="dietary_preferences"]:checked')
  var gender = document.querySelector('input[name="gender"]:checked')
  var personne = {
    login: document.getElementById('login').value,
    password: document.getElementById('password').value,
    id_regime: (dietary_preferences) ? dietary_preferences.value : null,
    sexe: (gender) ? gender.value : null,
    mail: document.getElementById('email').value,
    age: document.getElementById('age').value,
    sport: document.getElementById('physical_activity').value
  };
  console.log(personne);
  request.open("POST", "http://localhost/Projet%20IDAW/backend/user.php", true);
  request.send(JSON.stringify(personne))
}