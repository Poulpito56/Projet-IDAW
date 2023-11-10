const requestCreaType3 = new XMLHttpRequest();
const requestVerifType3 = new XMLHttpRequest();

// button.addEventListener("click", afficherNom)




function verifType3Log(log){

  fetch('http://localhost/Projet%20IDAW/backend/consommer.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
    .then(data => {
      requestVerifType3.open("GET", "http://localhost/Projet%20IDAW/backend/aliment.php?type=3&login="+log, true);
      requestVerifType3.send();
    })
    .catch(error => {
      mess = document.getElementById('messageAjoutPlat');
      mess.innerHTML = error;
    });
  
}

function ajoutPlatTemp(){
    var plat = {
        id_aliment: 0,
        nom: "Plat n°",
        type: 3,
        image_url: "https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Flat_tick_icon.svg/1024px-Flat_tick_icon.svg.png"
      };
      requestCreaType3.open("POST", "http://localhost/Projet%20IDAW/backend/aliment.php", true);
      requestCreaType3.send(JSON.stringify(plat));
}

requestVerifType3.onreadystatechange = function () {
  if (requestVerifType3.readyState == 4) {
      if (requestVerifType3.status != 200) {
      
      mess = document.getElementById('messageAjoutPlat');
      mess.innerHTML = JSON.parse(requestVerifType3.response).message;
    } else {
      if(JSON.parse(requestVerifType3.response).length == 0){
        ajoutPlatTemp(); 
      } else{
        window.location.href = "?page=add_dish"
      }
    }
  }
};

requestCreaType3.onreadystatechange = function () {
  if (requestCreaType3.readyState == 4) {
    if (requestCreaType3.status !== 201) {
      mess = document.getElementById('messageAjoutPlat');
      mess.innerHTML = JSON.parse(requestCreaType3.response).message;
    } else {
      window.location.href = "?page=add_dish"
    }
  }
};
