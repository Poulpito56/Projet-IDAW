function afficherAliments(idPlat){
  $(document).ready(function(){
    var tabAliment = $("#alimentTable").DataTable({
              ajax: {
                    url: "http://localhost/Projet%20IDAW/backend/aliments.php",
                    dataSrc: ''
              },
              
              columns: [
                    { data: 'ID_ALIMENT',
                    render: function(data){
                         
                          return '<button class="text-button add-food-to-dish-button" id="button-'+data+'" onclick="ajoutAliment('+data+','+idPlat+')"></button>'}},
                    { data: 'NOM'},
                    { data: 'ENERGIE',
                    render: function(data){var calorie = DataTable.render
                          .number(' ', ',', 1, '', 'kcal')
                          .display(data);
                          displayAdd();
                          return calorie;
                          }
                    },
                    { data: 'IMAGE_URL',
                    render: function(data){ return '<img src="'+data+'" style="height:70px;"/>'}}
                    
              ]

        });
        tabAliment.on('draw.dt', function(){
          displayAdd();
        })
  })
  
}
const requestVerifType3 = new XMLHttpRequest();

function verifType3Log(log){
  requestVerifType3.open("GET", "http://localhost/Projet%20IDAW/backend/aliment.php?type=3&login="+log, true);
  requestVerifType3.send();
}


requestVerifType3.onreadystatechange = function () {
if (requestVerifType3.readyState == 4) {
    if (requestVerifType3.status != 200) {
    
    mess = document.getElementById('messageAjoutPlat');
    mess.innerHTML = JSON.parse(requestVerifType3.response).message;
  } else {
    if(JSON.parse(requestVerifType3.response).length == 0){
      document.getElementById("pasDePlat").innerHTML = "Vous n'avez pas de plat en cours";
    } else{
      afficherAliments(JSON.parse(requestVerifType3.response)[0].ID_ALIMENT);
    }
  }
}
};
const log = getUser();
verifType3Log(log);


 

function ajoutAliment(idAli, idPlat){
  but = document.getElementById("button-"+idAli);
  but.disabled = true;
  conteneur = {"id_aliment": idPlat, "ali_id_aliment": idAli, "poids": 100};
  fetch('http://localhost/Projet%20IDAW/backend/contenir.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(conteneur)
      })
        .then(data => {
          but.classList.remove('add-food-to-dish-button');
          but.classList.add('sup-food-to-dish-button');
          but.classList.add('red-background');
          but.setAttribute('onclick', `supprimerAliment(${idAli}, ${idPlat})`)
          displaySup();
          but.disabled = false;
        })
        .catch(error => {
          mess = document.getElementById('messageAjoutPlat');
          mess.innerHTML = error;
        });
}

function supprimerAliment(idAli, idPlat){
  but = document.getElementById("button-"+idAli);
  but.disabled = true;
  fetch(`http://localhost/Projet%20IDAW/backend/contenir.php?id_aliment=${idPlat}&ali_id_aliment=${idAli}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json'
        }
      })
        .then(data => {
          but.classList.remove('sup-food-to-dish-button');
          but.classList.remove('red-background');
          but.classList.add('add-food-to-dish-button');
          but.setAttribute('onclick', `ajoutAliment(${idAli}, ${idPlat})`)
          displayAdd();
          but.disabled = false;
        })
        .catch(error => {
          mess = document.getElementById('messageAjoutPlat');
          mess.innerHTML = error;
        });

}