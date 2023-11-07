const button = document.getElementById("ajout_plat")
const nom = document.querySelector("fieldset")
const request2 = new XMLHttpRequest();
const requestVerifType3 = new XMLHttpRequest();

// button.addEventListener("click", afficherNom)



button.addEventListener("click", verifType3)

function verifType3(){
  fetch('http://localhost/Projet%20IDAW/backend/aliment.php?type=3', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    },
  })
  .then(response => {
    if (!response.ok) {
      throw new Error("Réponse du serveur non valide");
    }
    return response.json();
  })
  .then(data => {
    console.log(data);
  })
  .catch(error => {
    console.error("Une erreur s'est produite : " + error);
  });
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

requestVerifType3.onreadystatechange = function () {
  if (requestVerifType3.readyState == 4) {
    if (requestVerifType3.status !== 200) {
      if((requestVerifType3.message) == ""){
      mess.innerHTML = "ça marche";

      }
      mess = document.getElementById('messageAjoutPlat');
      mess.innerHTML = JSON.parse(requestVerifType3.response).message;
    } else {
      mess = document.getElementById('messageAjoutPlat');
      mess.innerHTML = JSON.parse(requestVerifType3.response).message;
      //window.location.href = "?page=add_dish"
    }
  }
};

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