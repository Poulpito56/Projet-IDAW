const request = new XMLHttpRequest();

function formatDate(date) {
  var year = date.toLocaleString("default", { year: "numeric" });
  var month = date.toLocaleString("default", { month: "2-digit" });
  var day = date.toLocaleString("default", { day: "2-digit" });

  return [year, month, day].join('-');
}

request.onreadystatechange = function () {
  if (request.readyState == 4) {
    if (request.status !== 200) {
      mess = document.getElementById('track_food_error_message');
      mess.innerHTML = JSON.parse(request.response).message
    } else {
      var trackFoodContainer = document.getElementById('track_food_container');
      console.log(request.response)
    }
  }
};

dateSelection = document.getElementById('date_selection');

request.open("GET", `http://localhost/Projet%20IDAW/backend/consommer.php?login=${user}&date_consommation=${dateSelection.value}`, true);
request.send()

dateSelection.addEventListener("submit", function (event) {
  event.preventDefault();
  connexion();
})