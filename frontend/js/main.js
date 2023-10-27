function afficherAliments(){
      
      const req = new XMLHttpRequest();

      req.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                  console.log(JSON.parse(req.response));

                  const body = document.getElementById('alimentTableBody');
                  body.innerHTML ='';

                  JSON.parse(req.response).forEach(aliment => {

                        const ligne = document.createElement('tr');

                        ligne.innerHTML = `<td>${aliment.NOM}</td>
                                          <td>${aliment.ID_ALIMENT}</td>
                                          <td>${aliment.ENERGIE}</td>
                                          <td><img src="${aliment.IMAGE_URL}"></td>
                                          `;
                        body.appendChild(ligne);
                      });
            }
      }
      req.open("GET", "http://localhost/Projet%20IDAW/backend/aliments.php");
      req.send();
}

afficherAliments();
