<html>
    <header>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <?php include 'ProductResult.php'; ?>
    <?php include 'Functions/dbconnections.php'; ?>

    </header>

    <body>

    <?php include 'includes/Header.php'; ?>

    <a  class="btn btn-primary" href="Resultaten.php? <?php print ('cat='.$_GET['cat'].'&search='. $_GET['search'].'&select=25'); ?>"> 25 </a>
    <a  class="btn btn-primary" href="Resultaten.php? <?php print ('cat='.$_GET['cat'].'&search='. $_GET['search'].'&select=50'); ?>"> 50 </a>
    <a  class="btn btn-primary" href="Resultaten.php? <?php print ('cat='.$_GET['cat'].'&search='. $_GET['search'].'&select=100'); ?>"> 100 </a>

    <?php
        Resultaten($_GET['search'], $_GET['cat'], $_GET['select']);

        function Resultaten($search, $cat, $resultatenPerPagina){

            // Checkt welke pagina nr je bevindt
            if(isset($_GET['pagenr'])) {
                $pagenr = $_GET['pagenr'];
            } else {
                $pagenr = 1;
            }

            //$resultatenPerPagina = $_GET['select'];
            $Offset = ($pagenr-1) * $resultatenPerPagina;

            
            if (!empty($cat)) {

                $input = $cat;

                $query_rows = ("SELECT *
                    FROM stockitems si
                    JOIN stockitemstockgroups stg ON si.StockItemID = stg.StockItemID
                    WHERE StockGroupID = $input ;
                ");
    
                //Check hoeveel resultaten zijn er
                $result = dbConnectionRoot($query_rows);
                $aantalResultaten = mysqli_num_rows($result);
                $aantalPaginas = ceil($aantalResultaten / $resultatenPerPagina);
    
    
                // query die de goede resultaten ophaal            
                $query = ("SELECT si.StockItemID, si.StockItemName, si.MarketingComments, si.SearchDetails, si.RecommendedRetailPrice, sh.QuantityOnHand, si.Photo
                    FROM stockitems si
                    JOIN stockitemstockgroups stg ON si.StockItemID = stg.StockItemID
                    JOIN stockitemholdings sh ON sh.StockItemID = si.StockItemID
                    WHERE StockGroupID = $input
                    LIMIT  $Offset, $resultatenPerPagina;
                ");
    
                $result = dbConnectionRoot($query);
    
                WeergevenProducten($result);


            } elseif (!empty($search)){

                $input = $search;

                $query_rows = (" SELECT *
                    FROM stockitems
                    WHERE StockItemID LIKE '%$input%' OR SearchDetails LIKE '%$input%';
                ");

                //Check hoeveel resultaten zijn er
                $result = dbConnectionRoot($query_rows);
                $aantalResultaten = mysqli_num_rows($result);
                $aantalPaginas = ceil($aantalResultaten / $resultatenPerPagina);

                $query = ("SELECT si.StockItemID, StockItemName, Photo, MarketingComments, RecommendedRetailPrice, QuantityOnHand
                    FROM stockitems si
                    JOIN stockitemholdings sih ON sih.StockItemID = si.StockItemID
                    WHERE si.StockItemID LIKE '%$input%' OR SearchDetails LIKE '%$input%'
                    LIMIT $Offset, $resultatenPerPagina;
                ");

                $result = dbConnectionRoot($query);

                WeergevenProducten($result);

            }

            print('<a  class="btn btn-primary" href="Resultaten.php?cat='.$_GET["cat"].'&search='. $_GET["search"].'&select=' . $_GET["select"].'"> first </a>');
            print('<a  class="btn btn-primary" href="Resultaten.php?cat='.$_GET["cat"].'&search='. $_GET["search"].'&select=' . $_GET["select"].'&pagenr=' . ($pagenr -1). '"> prev </a>');
            print('<a  class="btn btn-primary" href="Resultaten.php?cat='.$_GET["cat"].'&search='. $_GET["search"].'&select=' . $_GET["select"].'&pagenr=' . ($pagenr +1). '"> next </a>');            
            print('<a  class="btn btn-primary" href="Resultaten.php?cat='.$_GET["cat"].'&search='. $_GET["search"].'&select=' . $_GET["select"].'&pagenr=' . $aantalPaginas. '"> last </a>');
            

        }
    
    ?>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


    <?php include 'Includes/Footer.php' ?>


    </body>
</html>