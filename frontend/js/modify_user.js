const request = new XMLHttpRequest();

request.onreadystatechange = function () {
  if (request.readyState == 4) {
    if (request.status !== 200) {
      mess = document.getElementById('messageProfile');
      mess.innerHTML = JSON.parse(request.response).message
    } else {
      location.reload();
    }
  }
};

var loginForm = document.getElementById('login_form');


loginForm.addEventListener("submit", function (event) {
  event.preventDefault();
  modifyUser();
})

function modifyUser() {
  var dietary_preferences = document.getElementById('dietary_preferences').value;
  const a = document.getElementById('gender');
  var gender = document.getElementById('gender').value;
  var email = document.getElementById('email').value;
  var age = document.getElementById('age').value;
  var physical_activity = document.getElementById('physical_activity').value;
  var personne = {
    login: user,
    id_regime: (dietary_preferences !== "") ? dietary_preferences : null,
    sexe: (gender !== "") ? gender : null,
    mail: (email !== "") ? email : null,
    age: (age !== "") ? age : null,
    sport: (physical_activity !== "") ? physical_activity : null
  };
  request.open("PUT", "http://localhost/Projet%20IDAW/backend/user.php", true);
  request.send(JSON.stringify(personne))
}