const button = document.getElementById("ajout_plat")
const nom = document.querySelector("fieldset")
const request2 = new XMLHttpRequest();
const requestVerifType3 = new XMLHttpRequest();

// button.addEventListener("click", afficherNom)



button.addEventListener("click", ajoutPlatTemp)

function verifType3(){
  
}

function ajoutPlatTemp(){
    var plat = {
        id_aliment: 0,
        nom: "temp",
        type: 3,
        image_url: "https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Flat_tick_icon.svg/1024px-Flat_tick_icon.svg.png"
      };
      request2.open("POST", "http://localhost/Projet%20IDAW/backend/aliment.php", true);
      request2.send(JSON.stringify(plat));
}



request2.onreadystatechange = function () {
  if (request2.readyState == 4) {
    if (request2.status !== 201) {
      mess = document.getElementById('messageAjoutPlat');
      mess.innerHTML = JSON.parse(request2.response).message;
    } else {
      window.location.href = "?page=add_dish"
    }
  }
};
/*
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

*/