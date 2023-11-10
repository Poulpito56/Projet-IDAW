const request = new XMLHttpRequest();

function formatDateToDMY(dateString) {
  var parts = dateString.split("-");
  if (parts.length === 3) {
    return parts[2] + "/" + parts[1] + "/" + parts[0];
  } else {
    // Gestion d'une entrée invalide
    return "Format de date invalide";
  }
}

// Fonction pour convertir le format de date de dd/mm/yyyy à yyyy-mm-dd
function formatDateToYMD(dateString) {
  var parts = dateString.split("/");
  if (parts.length === 3) {
    return parts[2] + "-" + parts[1] + "-" + parts[0];
  } else {
    // Gestion d'une entrée invalide
    return "Format de date invalide";
  }
}

function deleteConso(id_conso) {
  fetch(`http://localhost/Projet%20IDAW/backend/consommer.php?id_consommation=${id_conso}`, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json'
    }
  })
    .catch(error => {
      console.error('Erreur :', error);
    });
  location.reload();
}

function modifyConso(id_conso) {
  let row = document.getElementById('id_consommation_' + id_conso);
  row.classList.add('green-background')

  // On change l'affichage de la quantité par un input
  let quantite = row.getElementsByClassName("consomation-aliment-quantite");
  quantite[0].innerHTML = `<input type="number" class="text-input" value="${quantite[0].innerHTML}">`;

  // On change l'affichage de la date par un input
  let date = row.getElementsByClassName("consomation-aliment-date");
  date[0].innerHTML = `<input type="date" class="text-input" value="${formatDateToYMD(date[0].innerHTML)}">`;

  // On change le bouton modifier par valider
  let valider = row.getElementsByClassName("consomation-aliment-modifier");

  valider[0].classList.add('consomation-aliment-valider');
  valider[0].setAttribute('onclick', `validateConso(${id_conso})`);
  valider[0].classList.remove('consomation-aliment-modifier');
  displayValidate();
}

function validateConso(id_conso) {
  let row = document.getElementById('id_consommation_' + id_conso);
  row.classList.remove('green-background')

  let quantite = row.getElementsByTagName('input');

  quantiteField = row.getElementsByClassName("consomation-aliment-quantite");
  nouvelleQuantite = quantite[0].value
  quantiteField[0].innerHTML = `${nouvelleQuantite}`;

  let date = row.getElementsByTagName('input');

  dateField = row.getElementsByClassName("consomation-aliment-date");
  nouvelleDate = date[0].value
  dateField[0].innerHTML = `${formatDateToDMY(nouvelleDate)}`;

  fetch('http://localhost/Projet%20IDAW/backend/consommer.php?', {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      id_consommation: id_conso,
      quantite: nouvelleQuantite,
      date_consommation: "'" + nouvelleDate + "'"
    })
  })
    .catch(error => {
      console.error('Erreur :', error);
    });

  // On change le bouton modifier par valider
  let modifier = row.getElementsByClassName("consomation-aliment-valider");

  modifier[0].classList.add('consomation-aliment-modifier');
  modifier[0].setAttribute('onclick', `modifyConso(${id_conso})`);
  modifier[0].classList.remove('consomation-aliment-valider')
  displayModify();
  location.reload();
}

function displayConso(consommation) {
  id_aliment = consommation['ID_ALIMENT'];
  return fetch(`http://localhost/Projet%20IDAW/backend/aliment.php?id_aliment=${id_aliment}`)
    .then(response => {
      if (!response.ok) {
        throw new Error(`Erreur lors de la requête : ${response.status} - ${response.statusText}`);
      }
      return response.json(); // Convertir la réponse en JSON
    })
    .then(response => { return response[0] })
    .then(aliment => {

      // Ajout image aliment
      let aliment_image = document.createElement('img');
      aliment_image.classList.add('consomation-aliment-image');
      aliment_image.setAttribute('src', aliment['IMAGE_URL']);

      // Ajout nom aliment
      let aliment_name = document.createElement('div');
      aliment_name.classList.add('consomation-aliment-name');
      aliment_name.innerHTML = aliment['NOM'];

      // Ajout quantite aliment
      let quantite = document.createElement('div');
      quantite.classList.add('consomation-aliment-quantite');
      quantite.innerHTML = consommation['QUANTITE'];

      // Ajout date consommation
      let date = document.createElement('div');
      date.classList.add('consomation-aliment-date');
      date.innerHTML = formatDateToDMY(consommation['DATE_CONSOMMATION']);

      // Ajout bouton modifier
      let modifier = document.createElement('button');
      modifier.classList.add('consomation-aliment-modifier');
      modifier.classList.add('text-button');
      modifier.setAttribute('onclick', `modifyConso(${consommation['ID_CONSOMMATION']})`);

      // Ajout bouton supprimer
      let supprimer = document.createElement('button');
      supprimer.classList.add('consomation-aliment-supprimer');
      supprimer.classList.add('text-button');
      supprimer.classList.add('red-background');
      supprimer.setAttribute('onclick', `deleteConso(${consommation['ID_CONSOMMATION']})`);

      let buttons = document.createElement('div');
      buttons.classList.add('consomation-aliment-buttons');
      buttons.append(modifier);
      buttons.append(supprimer);

      return { aliment_image, aliment_name, quantite, date, buttons };
    })
    .catch(error => {
      console.error('Erreur :', error);
    });
}

request.onreadystatechange = function () {
  if (request.readyState == 4) {
    if (request.status !== 200) {
      mess = document.getElementById('track_food_error_message');
      mess.innerHTML = reverse(JSON.parse(request.response).message)
    } else {
      // Construction du code HTML de la page pour afficher les consommations
      var trackFoodContainer = document.getElementById('track_food_container');
      trackFoodContainer.innerHTML = "";
      var rep = JSON.parse(request.response).reverse();

      for (var key in rep) { // Parcours des éléments de la table consommation demandés
        let row = document.createElement('div');
        row.classList.add('consomation-aliment-row');
        consommation = rep[key];
        row.id = "id_consommation_" + consommation['ID_CONSOMMATION'];

        const fields = displayConso(consommation)

        fields.then(data => {

          for (let field in data) {
            row.append(data[field]);
          }

          trackFoodContainer.append(row);

          displayModify();
          displayDelete();

        })
      }

    }
  }
};

dateSelection = document.getElementById('date_selection');

request.open("GET", `http://localhost/Projet%20IDAW/backend/consommer.php?login=${user}&date_consommation=${dateSelection.value}`, true);
request.send()

dateSelection.addEventListener("change", function () {
  request.open("GET", `http://localhost/Projet%20IDAW/backend/consommer.php?login=${user}&date_consommation=${dateSelection.value}`, true);
  request.send()
});