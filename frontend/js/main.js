function afficherAliments(){
      $(document).ready(function(){
            $("#alimentTable").DataTable({
                  ajax: {
                        url: "http://localhost/Projet%20IDAW/backend/aliments.php",
                        dataSrc: ''
                  },
                  columns: [
                        { data: 'NOM'},
                        { data: 'ID_ALIMENT'},
                        { data: 'ENERGIE'},
                        { data: 'IMAGE_URL',
                        render: function(data){ return '<img src="'+data+'" style="height:70px;"/>'}}
                        
                  ]

            });
      })
      
}

afficherAliments();
