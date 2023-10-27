const request = new XMLHttpRequest();

var personne = new FormData();

personne.append("login", "aaa");
personne.append("password", "faefeaf");
personne.append("admin", true);



request.open("POST", "http://localhost/Projet%20IDAW/backend/user.php", true);

request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

request.send(personne)