<html>
    <header>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <?php include 'ProductResult.php'; ?>

    </header>

    <body>

    <?php

        // Checkt welke pagina nr je bevindt
        if(isset($_GET['pagenr'])) {
            $pagenr = $_GET['pagenr'];
        } else {
            $pagenr = 1;
        }

        $resultatenPerPagina = 10;
        $Offset = ($pagenr-1) * $resultatenPerPagina;

        //db connectie info
        $dbServername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "wideworldimporters";

        $connection = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

        $input = 6;

        $query_rows = ("SELECT *
        FROM stockitems si
        JOIN stockitemstockgroups stg ON si.StockItemID = stg.StockItemID
        WHERE StockGroupID = $input ;
        ");

        //Check hoeveel resultaten zijn er
        $result = mysqli_query($connection, $query_rows);
        $aantalResultaten = mysqli_num_rows($result);
        $aantalPaginas = ceil($aantalResultaten / $resultatenPerPagina);


        // query die de goede resultaten ophaal            
        $query = ("SELECT si.StockItemID, si.StockItemName, si.MarketingComments, si.SearchDetails, si.RecommendedRetailPrice, sh.QuantityOnHand, si.Photo
        FROM stockitems si
        JOIN stockitemstockgroups stg ON si.StockItemID = stg.StockItemID
        JOIN stockitemholdings sh ON sh.StockItemID = si.StockItemID
        WHERE StockGroupID = $input
        LIMIT  $Offset, $resultatenPerPagina;");

        WeergevenProducten($connection, $query);

    
    ?>

    <a href="Resultaten.php" class="btn btn-primary"> First </a> <br><br>

    <a href="Resultaten.php?pagenr=<?php print ($pagenr + 1)?>" class="btn btn-primary"> Next </a> <br><br>

    <a href="Resultaten.php?pagenr=<?php print ($pagenr - 1)?>" class="btn btn-primary"> Prev </a> <br><br>

    <a href="Resultaten.php?pagenr=<?php print ($aantalPaginas)?>" class="btn btn-primary"> Last </a>


    </body>
</html>