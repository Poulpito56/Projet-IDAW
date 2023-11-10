

function afficherAlimentsType2Log(login) {
      $(document).ready(function () {
            $("#alimentT2Table").DataTable({
                  ajax: {
                        url: "http://localhost/Projet%20IDAW/backend/aliment.php?type=2&login=" + login,
                        dataSrc: ''
                  },
                  columns: [
                        {
                              data: 'ID_ALIMENT',
                              render: function (data) { return `<button class="text-button consume-dish-button" onclick="consumeDish${data}"></button>` }
                        },
                        { data: 'NOM' },
                        /*{ data: 'ID_ALIMENT',
                        render: function(data){
                              return '<div class="code-barre">'+data+'</div>'}},*/
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
      })

}


function afficherAlimentsPlat(id) {
      $(document).ready(function () {
            $("#alimentTablePlat").DataTable({
                  ajax: {
                        url: "http://localhost/Projet%20IDAW/backend/contenir.php?id_aliment=" + id,
                        dataSrc: ''
                  },
                  columns: [
                        { data: 'NOM' },
                        {
                              data: 'ID_ALIMENT',
                              render: function (data) {
                                    return '<div class="code-barre">' + data + '</div>'
                              }
                        },
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
                        }

                  ],


            });
      })

}

