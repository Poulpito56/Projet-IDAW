// Fonction pour récupérer et afficher la liste des utilisateurs
function afficherListeUtilisateurs() {
    fetch('../../backend/aliments.php', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    })

    .then(response => response.json())
    .then(data => {
      const userList = document.getElementById('userList');
      userList.innerHTML = ''; // Effacer la liste existante
      data.forEach(user => {
        const listItem = document.createElement('li');
        listItem.textContent = `name: ${user.name}, Email: ${user.email}`;
        userList.appendChild(listItem);
      });
    })
    .catch(error => {
      console.error(error);
    });
}
  
    /*
      .then(response => response.json())
      .then(data => {
        const userList = document.getElementById('userList');
        userList.innerHTML = ''; // Effacer la liste existante
        data.forEach(user => {
          const listItem = document.createElement('li');
          listItem.textContent = `name: ${user.name}, Email: ${user.email}`;
          userList.appendChild(listItem);
        });
      })
      .catch(error => {
        console.error(error);
      });
  }
  */
 /*
  
  // Fonction pour ajouter un utilisateur
  function ajouterUtilisateur() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
  
    if (!name || !email) {
      alert("Les champs 'name' et 'E-mail' sont obligatoires.");
      return;
    }
  
    const data = { name, email };
  
    fetch('users.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
      .then(response => response.json())
      .then(data => {
        alert(`Utilisateur créé avec succès. ID: ${data.id}`);
        afficherListeUtilisateurs(); // Actualiser la liste des utilisateurs
      })
      .catch(error => {
        console.error(error);
      });
  }

  
  // Charger la liste des utilisateurs au chargement de la page
  afficherListeUtilisateurs();

  */