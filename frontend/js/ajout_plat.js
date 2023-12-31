
function ajout_aliment() {
  const donnees = {
    id_aliment: document.getElementById("idNouvPlat").value,
    id_regime: document.getElementById("regime-alim-nouv-plat").value,
    nom: document.getElementById("titreNouvPlat").value,
    type: 3,
    glucide: 0,
    energie: 0,
    gras: 0,
    fibre: 0,
    proteine: 0,
    sel: 0,
    graisses_saturees: 0,
    sucre: 0,
  };
  const quantites = document.getElementsByClassName('quantite');
  if (quantites.length == 0) {
    fetch(apiPath + 'backend/aliment.php', {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(donnees)
    }).then(data => {
      window.location.href = "?page=food"
    })
      .catch(error => {
        console.error('Erreur :', error);
      });

  } else {

    fetch(apiPath + `backend/contenir.php?id_aliment=${donnees.id_aliment}&somme=1`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      },
    })
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        // Parse the JSON content of the response
        return response.json();
      })
      .then(result => {
        var poidsTotal = 0;

        for (let i = 0; i < quantites.length; i++) {
          const id = quantites[i].id;
          const val = quantites[i].value;
          poidsTotal = poidsTotal + parseFloat(val);
          fetch(apiPath + `backend/aliment.php?id_aliment=${id}`, {
            method: 'GET',
            headers: {
              'Content-Type': 'application/json'
            },
          })
            .then(response => {
              if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
              }
              // Parse the JSON content of the response
              return response.json();
            })
            .then(result => {

              donnees.glucide = donnees.glucide + val * result[0].GLUCIDE;
              donnees.energie = donnees.energie + val * result[0].ENERGIE;
              donnees.gras = donnees.gras + val * result[0].GRAS;
              donnees.fibre = donnees.fibre + val * result[0].FIBRE;
              donnees.proteine = donnees.proteine + val * result[0].PROTEINE;
              donnees.sel = donnees.sel + val * result[0].SEL;
              donnees.graisses_saturees = donnees.graisses_saturees + val * result[0].GRAISSES_SATUREES;
              donnees.sucre = donnees.sucre + val * result[0].SUCRE;

              if (i == quantites.length - 1) {

                donnees.glucide = donnees.glucide / poidsTotal;
                donnees.energie = donnees.energie / poidsTotal;
                donnees.gras = donnees.gras / poidsTotal;
                donnees.fibre = donnees.fibre / poidsTotal;
                donnees.proteine = donnees.proteine / poidsTotal;
                donnees.sel = donnees.sel / poidsTotal;
                donnees.graisses_saturees = donnees.graisses_saturees / poidsTotal;
                donnees.sucre = donnees.sucre / poidsTotal;
                console.log(poidsTotal);
                fetch(apiPath + 'backend/aliment.php', {
                  method: 'PUT',
                  headers: {
                    'Content-Type': 'application/json'
                  },
                  body: JSON.stringify(donnees)
                }).then(data => {
                  window.location.href = "?page=food"
                })
                  .catch(error => {
                    console.error('Erreur :', error);
                  });
              }
            })
            .catch(error => {
              console.error(error);
            })
        }
      })
      .catch(error => {
        console.error(error);
      })
  }
}

function validerNouvPlat() {
  const donnees = {
    id_aliment: document.getElementById("idNouvPlat").value,
    id_regime: document.getElementById("regime-alim-nouv-plat").value,
    nom: document.getElementById("titreNouvPlat").value,
    type: 2,
    glucide: 0,
    energie: 0,
    gras: 0,
    fibre: 0,
    proteine: 0,
    sel: 0,
    graisses_saturees: 0,
    sucre: 0,
  };
  const quantites = document.getElementsByClassName('quantite');
  if (quantites.length == 0) {
    fetch(apiPath + 'backend/aliment.php', {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(donnees)
    }).then(data => {
      window.location.href = "?page=food"
    })
      .catch(error => {
        console.error('Erreur :', error);
      });

  } else {

    fetch(apiPath + `backend/contenir.php?id_aliment=${donnees.id_aliment}&somme=1`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      },
    })
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        // Parse the JSON content of the response
        return response.json();
      })
      .then(result => {
        var poidsTotal = 0;

        for (let i = 0; i < quantites.length; i++) {
          const id = quantites[i].id;
          const val = quantites[i].value;
          poidsTotal = poidsTotal + parseFloat(val);
          fetch(apiPath + `backend/aliment.php?id_aliment=${id}`, {
            method: 'GET',
            headers: {
              'Content-Type': 'application/json'
            },
          })
            .then(response => {
              if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
              }
              // Parse the JSON content of the response
              return response.json();
            })
            .then(result => {

              donnees.glucide = donnees.glucide + val * result[0].GLUCIDE;
              donnees.energie = donnees.energie + val * result[0].ENERGIE;
              donnees.gras = donnees.gras + val * result[0].GRAS;
              donnees.fibre = donnees.fibre + val * result[0].FIBRE;
              donnees.proteine = donnees.proteine + val * result[0].PROTEINE;
              donnees.sel = donnees.sel + val * result[0].SEL;
              donnees.graisses_saturees = donnees.graisses_saturees + val * result[0].GRAISSES_SATUREES;
              donnees.sucre = donnees.sucre + val * result[0].SUCRE;

              if (i == quantites.length - 1) {

                donnees.glucide = donnees.glucide / poidsTotal;
                donnees.energie = donnees.energie / poidsTotal;
                donnees.gras = donnees.gras / poidsTotal;
                donnees.fibre = donnees.fibre / poidsTotal;
                donnees.proteine = donnees.proteine / poidsTotal;
                donnees.sel = donnees.sel / poidsTotal;
                donnees.graisses_saturees = donnees.graisses_saturees / poidsTotal;
                donnees.sucre = donnees.sucre / poidsTotal;
                console.log(poidsTotal);
                fetch(apiPath + 'backend/aliment.php', {
                  method: 'PUT',
                  headers: {
                    'Content-Type': 'application/json'
                  },
                  body: JSON.stringify(donnees)
                }).then(data => {
                  window.location.href = "?page=dish"
                })
                  .catch(error => {
                    console.error('Erreur :', error);
                  });
              }
            })
            .catch(error => {
              console.error(error);
            })
        }
      })
      .catch(error => {
        console.error(error);
      })
  }
}