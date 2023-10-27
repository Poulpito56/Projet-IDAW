const request = new XMLHttpRequest();

request.onreadystatechange = function () {
  if (request.readyState == 4) {
    if (request.status !== 201) {
      mess = document.getElementById('message');
      mess.innerHTML = JSON.parse(request.response).message
    } else {
      window.location.href = "index.php";
    }
  }
};

var loginForm = document.getElementById('login_form');


loginForm.addEventListener("submit", function (event) {
  event.preventDefault();
  insertNewUser();
})

function insertNewUser() {
  var personne = {
    login: document.getElementById('login').value,
    password: document.getElementById('password').value
  };
  request.open("POST", "http://localhost/Projet%20IDAW/backend/user.php", true);
  request.send(JSON.stringify(personne))
}