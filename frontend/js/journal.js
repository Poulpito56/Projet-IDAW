const request = new XMLHttpRequest();

// Récupérer le contexte du canevas
const ctx = document.getElementById('monGraphique').getContext('2d');
var monGraphique = new Chart(ctx, {});

dateSelection = document.getElementById('date_selection');

function initEnargyData(date) {
  const dateDebut = new Date(date);
  dateDebut.setDate(dateDebut.getDate() + 1);
  const dateActuelle = new Date();
  const objetDates = {};

  // Boucle à travers les dates depuis la date de début jusqu'à la date actuelle
  for (let dateCourante = dateDebut; dateCourante <= dateActuelle; dateCourante.setDate(dateCourante.getDate() + 1)) {
    const cle = dateCourante.toLocaleDateString('fr-FR'); // Format "dd/mm/yyyy"
    objetDates[cle] = 0;
  }

  return objetDates;
}

function formatDateToDMY(dateString) {
  var parts = dateString.split("-");
  if (parts.length === 3) {
    return parts[2] + "/" + parts[1] + "/" + parts[0];
  } else {
    // Gestion d'une entrée invalide
    return "Format de date invalide";
  }
}

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

function calculEnergie() {
  return fetch(`http://localhost/Projet%20IDAW/backend/user.php?login=${user}`)
    .then(response => {
      if (!response.ok) {
        throw new Error(`Erreur lors de la requête : ${response.status} - ${response.statusText}`);
      }
      return response.json();
    })
    .then(data => {
      return data[0];
    })
    .then(data => {
      const age = data['AGE'] ?? 30;
      const poids = data['POIDS'] ?? 70;
      const taille = data['TAILLE'] ?? 170;
      const genre = data['SEXE'] ?? 1;
      const activitePhysique = data['SPORT'] ?? 5;

      let bmr;

      if (genre === 3) { // homme
        bmr = 88.362 + (13.397 * poids) + (4.799 * taille) - (5.677 * age);
      } else if (genre === 2) { // femme
        bmr = 447.593 + (9.247 * poids) + (3.098 * taille) - (4.330 * age);
      } else { // non spécifié
        bmr = 10 * poids + 6.25 * taille - 5 * age + 5;
      }

      const facteurActivite = (1.3 / 9) * activitePhysique + (1.2 - 1.3 / 9);

      const tee = bmr * facteurActivite;

      return tee;
    })
}

function displayGraph(graphData) {

  const numberOfDays = Object.keys(graphData).length;
  const recommandedEnergy = calculEnergie();
  recommandedEnergy.then(data => {
    const recommandtions = new Array(numberOfDays).fill(data);

    monGraphique.destroy();

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
  })

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

      let enargyData = initEnargyData(dateSelection.value);

      rep.forEach(element => {
        const aliment = getAlimentById(element['ID_ALIMENT']);
        const date = formatDateToDMY(element['DATE_CONSOMMATION'])

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

request.open("GET", `http://localhost/Projet%20IDAW/backend/consommer.php?login=${user}&date_consommation=${dateSelection.value}`, true);
request.send()

dateSelection.addEventListener("change", function () {
  request.open("GET", `http://localhost/Projet%20IDAW/backend/consommer.php?login=${user}&date_consommation=${dateSelection.value}`, true);
  request.send()
});