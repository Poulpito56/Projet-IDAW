const request = new XMLHttpRequest();

var personne = {
  login: "aaa",
  password: "faefeaf",
  admin: true
};

request.open("POST", "http://localhost/Projet%20IDAW/backend/user.php", true);
request.send(JSON.stringify(personne))