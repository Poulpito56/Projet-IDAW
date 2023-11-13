const requestVerifType3 = new XMLHttpRequest();
function consumeDish(id_aliment) {
  var today = new Date();

  // Récupérez l'année, le mois et le jour
  var year = today.getFullYear();
  var month = ('0' + (today.getMonth() + 1)).slice(-2); // Ajoutez 1 car les mois commencent à 0
  var day = ('0' + today.getDate()).slice(-2);

  // Formatez la date au format "yyyy-mm-dd"
  var formattedDate = year + '-' + month + '-' + day;
  fetch(apiPath + 'backend/consommer.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      login: log,
      id_aliment: id_aliment,
      date_consommation: "'" + formattedDate + "'"
    })
  })
    .catch(error => {
      console.error('Erreur :', error);
    });

  btn = document.getElementById(`consume-button-${id_aliment}`)
  displayConsumedDish(id_aliment);
}



function verifType3Log(log) {
  requestVerifType3.open("GET", apiPath + "backend/aliment.php?type=3&login=" + log, true);
  requestVerifType3.send();
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
  const platTemp = { "id_aliment": 0, "nom": "Plat n°", "type": 3, "image_url": "https://cdn-icons-png.flaticon.com/512/4659/4659180.png" };
  fetch(apiPath + 'backend/aliment.php?', {
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
      const logIdAli = { "login": log, "id_aliment": result.id };
      fetch(apiPath + 'backend/consommer.php', {
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
