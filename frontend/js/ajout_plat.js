
function ajout_aliment(){
  window.location.href = "?page=food"
}

function validerNouvPlat(){
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

  for (const input of quantites) {
    const id = input.id;
    const val = input.value;
    fetch(`http://localhost/Projet%20IDAW/backend/aliment.php?id_aliment=${id}`, {
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
        console.log(result[0].ENERGIE);
          donnees.glucide = donnees.glucide + val * result[0].GLUCIDE / 100;
          donnees.energie = donnees.energie + val * result[0].ENERGIE / 100;
          donnees.gras = donnees.gras + val * result[0].GRAS / 100;
          donnees.fibre = donnees.fibre + val * result[0].FIBRE / 100;
          donnees.proteine = donnees.proteine + val * result[0].PROTEINE / 100;
          donnees.sel = donnees.sel + val * result[0].SEL / 100;
          donnees.graisses_saturees = donnees.graisses_saturees + val * result[0].GRAISSES_SATUREES / 100;
          donnees.sucre = donnees.sucre + val * result[0].SUCRE / 100;

          fetch('http://localhost/Projet%20IDAW/backend/aliment.php', {
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
      })
      .catch(error => {
        console.log(error);
      })
  }
  console.log(donnees);
  
  
}