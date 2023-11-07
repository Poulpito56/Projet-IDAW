const button = document.getElementById("ajout_plat")
const nom = document.querySelector("fieldset")
const request = new XMLHttpRequest();


// button.addEventListener("click", afficherNom)



button.addEventListener("click", ajoutPlatTemp)

function ajoutPlatTemp(){
    var plat = {
        id_aliment: 0,
        nom: "temp",
        type: 3,
        image_url: "https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Flat_tick_icon.svg/1024px-Flat_tick_icon.svg.png"
      };
      request.open("POST", "http://localhost/Projet%20IDAW/backend/aliment.php", true);
      request.send(JSON.stringify(plat));
}



request.onreadystatechange = function () {
  if (request.readyState == 4) {
    if (request.status !== 201) {
      mess = document.getElementById('messageAjoutPlat');
      mess.innerHTML = JSON.parse(request.response).message;
    } else {
      // Si l'utilisateur existe bien, on crée une session pour rester connecté
      const data = { "login": document.getElementById('login').value };

      window.location.href = 'index.php';
        
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