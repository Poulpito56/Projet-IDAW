const requestVerifType3 = new XMLHttpRequest();

<<<<<<< HEAD

function verifType3Log(log){
    requestVerifType3.open("GET", "http://localhost/Projet%20IDAW/backend/aliment.php?type=3&login="+log, true);
    requestVerifType3.send();
=======
// button.addEventListener("click", afficherNom)

function consumeDish(id_aliment) {

}


function verifType3Log(log) {
  requestVerifType3.open("GET", "http://localhost/Projet%20IDAW/backend/aliment.php?type=3&login=" + log, true);
  requestVerifType3.send();
>>>>>>> 71c2588d17bca82b83ea7c99a8153d34d03f65f1
}

requestVerifType3.onreadystatechange = function () {
  if (requestVerifType3.readyState == 4) {
    if (requestVerifType3.status != 200) {

      mess = document.getElementById('messageAjoutPlat');
      mess.innerHTML = JSON.parse(requestVerifType3.response).message;
    } else {
      if (JSON.parse(requestVerifType3.response).length == 0) {
        ajoutPlatTemp();
      } else {
        window.location.href = "?page=add_dish"
      }
    }
  }
};

function ajoutPlatTemp() {

  const log = getUser();
  const platTemp = { "id_aliment": 0, "nom": "Plat n°", "type": 3, "image_url": "https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Flat_tick_icon.svg/1024px-Flat_tick_icon.svg.png" };
  fetch('http://localhost/Projet%20IDAW/backend/aliment.php?', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(platTemp)
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      // Parse the JSON content of the response
      return response.json();
    })
    .then(result => {
      const logIdAli = { "login": log, "id_aliment":  result.id};
      console.log(logIdAli);
      fetch('http://localhost/Projet%20IDAW/backend/consommer.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(logIdAli)
      })
        .then(data => {
          window.location.href = "?page=add_dish"
        })
        .catch(error => {
          mess = document.getElementById('messageAjoutPlat');
          mess.innerHTML = error;
        });
    })
    .catch(error => {
      mess = document.getElementById('messageAjoutPlat');
      mess.innerHTML = error;
    });


};
