const request = new XMLHttpRequest();

request.onreadystatechange = function () {
  if (request.readyState == 4) {
    if (request.status !== 200) {
      mess = document.getElementById('track_food_error_message');
      mess.innerHTML = reverse(JSON.parse(request.response).message)
    } else {
      var trackFoodContainer = document.getElementById('track_food_container');
      trackFoodContainer.innerHTML = "";
      const rep = JSON.parse(request.response);
      for (consommation in rep) {
        let row = document.createElement('div');
        for (field in rep[consommation]) {
          let displayField = document.createElement('div');
          displayField.innerHTML = field + " : " + rep[consommation][field];
          row.append(displayField);
        }
        trackFoodContainer.append(row);
      }
    }
  }
};

dateSelection = document.getElementById('date_selection');

request.open("GET", `http://localhost/Projet%20IDAW/backend/consommer.php?login=${user}&date_consommation=${dateSelection.value}`, true);
request.send()

dateSelection.addEventListener("change", function () {
  request.open("GET", `http://localhost/Projet%20IDAW/backend/consommer.php?login=${user}&date_consommation=${dateSelection.value}`, true);
  request.send()
});