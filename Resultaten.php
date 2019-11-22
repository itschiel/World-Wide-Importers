<html>
    <header>

    <!-- Bootstrap CSS library link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Functie Includes -->
    <?php include 'ProductResult.php'; ?>
    <?php include 'Functions/dbconnections.php'; ?>

    </header>

    <body>

    <!-- deze include voegt de header toe -->
    <?php include 'includes/Header.php'; ?>


    <!-- Deze linkjes worden gebruikt om de resultaten per pagina aan te passen -->
    <!-- alle variablen worden hier weer in de link gezet anders kunnen deze niet meer gebruikt worden op de volgende pagina met resultaten-->
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

            
            // onderstaande if else statement kijkt welke search functie gebruikt is. keuze uit catogoriën of de search input.
            if (!empty($cat)) {

                $input = $cat;

                // onderstaande query wordt gebruikt voor de paginatie. hier wordt gekeken hoeveel resutltaten er zijn zodat het aantal pagina's berekend kan worden
                $query_rows = ("SELECT *
                    FROM stockitems si
                    JOIN stockitemstockgroups stg ON si.StockItemID = stg.StockItemID
                    WHERE StockGroupID = $input ;
                ");
    
                //hier wordt gekeken hoeveel records er zijn ontvangen en wordt er berekend hoeveel paginas er nodig zijn
                $result = dbConnectionRoot($query_rows);
                $aantalResultaten = mysqli_num_rows($result);
                $aantalPaginas = ceil($aantalResultaten / $resultatenPerPagina);
    

    
                // onderstaande query wordt gebruikt om de benodigde data op te halen die geplaatst dient te worden in de product kaarten           
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
                
                // onderstaande query wordt gebruikt voor de paginatie. hier wordt gekeken hoeveel resutltaten er zijn zodat het aantal pagina's berekend kan worden
                $query_rows = (" SELECT *
                    FROM stockitems
                    WHERE StockItemID LIKE '%$input%' OR SearchDetails LIKE '%$input%';
                ");

                //hier wordt gekeken hoeveel records er zijn ontvangen en wordt er berekend hoeveel paginas er nodig zijn
                $result = dbConnectionRoot($query_rows);
                $aantalResultaten = mysqli_num_rows($result);
                $aantalPaginas = ceil($aantalResultaten / $resultatenPerPagina);


                // onderstaande query wordt gebruikt om de benodigde data op te halen die geplaatst dient te worden in de product kaarten
                $query = ("SELECT si.StockItemID, StockItemName, Photo, MarketingComments, RecommendedRetailPrice, QuantityOnHand
                    FROM stockitems si
                    JOIN stockitemholdings sih ON sih.StockItemID = si.StockItemID
                    WHERE si.StockItemID LIKE '%$input%' OR SearchDetails LIKE '%$input%'
                    LIMIT $Offset, $resultatenPerPagina;
                ");

                $result = dbConnectionRoot($query);

                WeergevenProducten($result);

            }

            // met de onderstaande knoppen kan je naar de volgende pagina met resultaten gaan.
            // door $pagenr aan te passen worden de waardes van de limit in de query aangepast zodat de juiste producten verstuurd worden
            // alle variablen worden hier weer in de link gezet anders kunnen deze niet meer gebruikt worden op de volgende pagina met resultaten
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

    <!-- deze include voegt de header toe -->
    <?php include 'Includes/Footer.php' ?>


    </body>
</html>