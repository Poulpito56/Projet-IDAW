<!DOCTYPE html>
<html>

    <header>
        <meta charset='utf-8'>
        <script src="js/main.js" defer></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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