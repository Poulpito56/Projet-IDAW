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

// Récupérer le contexte du canevas
const ctx = document.getElementById('monGraphique').getContext('2d');

var monGraphique = new Chart(ctx, {});

function comparerDates(a, b) {
  return new Date(a.DATE_CONSOMMATION) - new Date(b.DATE_CONSOMMATION);
}

function getAlimentById(id_aliment) {
  return fetch(`http://localhost/Projet%20IDAW/backend/aliment.php?id_aliment=${id_aliment}`)
    .then(response => {
      if (!response.ok) {
        throw new Error(`Erreur lors de la requête : ${response.status} - ${response.statusText}`);
      }
      return response.json(); // Convertir la réponse en JSON
    })
}

function displayGraph(graphData) {

  monGraphique.destroy();

  const numberOfDays = Object.keys(graphData).length;
  const recommandtions = new Array(numberOfDays).fill(2500); // à modifier quand on fera le calcul de l'énergie moyenne

  // Créer le graphique à barres
  monGraphique = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: Object.keys(graphData),  // Les abscisses
      datasets: [{
        label: 'Kcal',
        data: Object.values(graphData),  // Les ordonnées
        backgroundColor: '#aad17d40',
        borderColor: '#aad17d',  // Couleur de la bordure des barres
        borderWidth: 1
      }, {
        type: 'line',
        label: 'Recommandation',
        data: recommandtions,
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}

request.onreadystatechange = function () {
  if (request.readyState == 4) {
    if (request.status !== 200) {
      mess = document.getElementById('journal_error_message');
      mess.innerHTML = reverse(JSON.parse(request.response).message)
    } else {
      // var journalContainer = document.getElementById('journal_container');
      // journalContainer.innerHTML = "";
      var rep = JSON.parse(request.response);

      // Trier le tableau en utilisant la fonction de comparaison
      rep.sort(comparerDates);

      let enargyData = {};

      rep.forEach(element => {
        const aliment = getAlimentById(element['ID_ALIMENT']);
        const date = formatDateToDMY(element['DATE_CONSOMMATION'])

        // Vérifier si la date existe déjà dans l'objet enargyData
        if (!enargyData[date]) {
          enargyData[date] = 0;
        }

        aliment
          .then(data => {
            return data[0];
          })
          .then(data => {
            enargyData[date] += data['ENERGIE'] * element['QUANTITE'] / 100;
            displayGraph(enargyData);
          })
      });
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