<!DOCTYPE html>
<html>

    <header>
        <meta charset='utf-8'>
        <script src="js/main.js" defer></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+EAN13+Text&family=Roboto&display=swap" rel="stylesheet">

    </header>

    <body>

        <table id="alimentTable" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Code barre</th>
                    <th scope="col">Energie</th>
                    <th scope="col">image</th>
                </tr>
            </thead>
            <tbody id="alimentTableBody">
            </tbody>
        </table>
    </body>

</html>