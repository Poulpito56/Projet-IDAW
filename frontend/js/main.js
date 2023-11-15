

function afficherAlimentsType2Log(login) {
  $(document).ready(function () {
    var tabAlimentT2 = $("#alimentT2Table").DataTable({
      ajax: {
        url: apiPath + "backend/aliment.php?type=2&login=" + login,
        dataSrc: ''
      },
      columns: [
        {
          data: 'ID_ALIMENT',
          render: function (data) { return `<button class="text-button consume-dish-button" id="consume-button-${data}" onclick="consumeDish(${data})"></button>` }
        },
        { data: 'NOM' },
        {
          data: 'ENERGIE',
          render: function (data) {
            displayAddDish();
            var calorie = DataTable.render
              .number(' ', ',', 1, '', 'kcal')
              .display(data);
            return calorie;
          }
        }
      ]
    });
    tabAlimentT2.on('draw.dt', function () {
      displayAddDish();
    })
  })

}


function afficherAlimentsPlat(id) {
  $(document).ready(function () {
    $("#alimentTablePlat").DataTable({
      ajax: {
        url: apiPath + "backend/contenir.php?id_aliment=" + id,
        dataSrc: ''
      },
      columns: [
        { data: 'NOM' },
        {
          data: 'ENERGIE',
          render: function (data) {
            var calorie = DataTable.render
              .number(' ', ',', 1, '', 'kcal')
              .display(data);
            return calorie;
          }
        },
        {
          data: 'IMAGE_URL',
          render: function (data) { return '<img src="' + data + '" style="height:70px;"/>' }
        },
        {
          data: 'ID_ALIMENT',
          render: function (data) {
            return '<input type="number" value="100" class="quantite text-input brown-border" id="' + data + '">'
          }
        }

      ],
    });
  })
}

