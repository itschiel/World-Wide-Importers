<html>
    <header>

    <!-- Bootstrap CSS library link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Functie Includes -->
    <?php include 'ProductResult.php'; ?>
    <?php include 'Functions/dbConnections.php'; ?>

    </header>

    <body>

    <!-- deze include voegt de header toe -->
    <?php include 'includes/Header.php'; ?>


    <!-- Deze linkjes worden gebruikt om de resultaten per pagina aan te passen -->
    <!-- alle variablen worden hier weer in de link gezet anders kunnen deze niet meer gebruikt worden op de volgende pagina met resulstaten-->
    <a  class="btn btn-primary" href="Results.php? <?php print ('cat='.$_GET['cat'].'&search='. $_GET['search'].'&select=25'); ?>"> 25 </a>
    <a  class="btn btn-primary" href="Results.php? <?php print ('cat='.$_GET['cat'].'&search='. $_GET['search'].'&select=50'); ?>"> 50 </a>
    <a  class="btn btn-primary" href="Results.php? <?php print ('cat='.$_GET['cat'].'&search='. $_GET['search'].'&select=100'); ?>"> 100 </a>

    <?php
        Results($_GET['search'], $_GET['cat'], $_GET['select']);

        function Results($search, $cat, $resultsPerPage){

            // Checkt welke pagina nr je bevindt
            if(isset($_GET['pagenr'])) {
                $pageNumber = $_GET['pagenr'];
            } else {
                $pageNumber = 1;
            }

            //$resultsPerPage = $_GET['select'];
            $Offset = ($pageNumber-1) * $resultsPerPage;

            
            // onderstaande if else statement kijkt welke search functie gebruikt is. keuze uit catogoriën of de search input.
            if (!empty($cat)) {

                $input = $cat;

                // onderstaande query wordt gebruikt voor de paginatie. hier wordt gekeken hoeveel resutltaten er zijn zodat het aantal pagina's berekend kan worden
                $queryRows = ("SELECT *
                    FROM stockitems si
                    JOIN stockitemstockgroups stg ON si.StockItemID = stg.StockItemID
                    WHERE StockGroupID = $input ;
                ");
    
                //hier wordt gekeken hoeveel records er zijn ontvangen en wordt er berekend hoeveel paginas er nodig zijn
                $result = mysqli_query(dbConnectionRoot(), $queryRows);
                $numberOfResults = mysqli_num_rows($result);
                $numberOfPages = ceil($numberOfResults / $resultsPerPage);
    

    
                // onderstaande query wordt gebruikt om de benodigde data op te halen die geplaatst dient te worden in de product kaarten           
                $query = ("SELECT si.StockItemID, si.StockItemName, si.MarketingComments, si.SearchDetails, si.RecommendedRetailPrice, sh.QuantityOnHand, si.Photo
                    FROM stockitems si
                    JOIN stockitemstockgroups stg ON si.StockItemID = stg.StockItemID
                    JOIN stockitemholdings sh ON sh.StockItemID = si.StockItemID
                    WHERE StockGroupID = $input
                    LIMIT  $Offset, $resultsPerPage;
                ");

                $result = mysqli_query(dbConnectionRoot(), $query);
    
                showProductCards($result);


            } elseif (!empty($search)){

                $input = $search;
                
                // onderstaande query wordt gebruikt voor de paginatie. hier wordt gekeken hoeveel resutltaten er zijn zodat het aantal pagina's berekend kan worden
                $queryRows = (" SELECT *
                    FROM stockitems
                    WHERE StockItemID LIKE '%$input%' OR SearchDetails LIKE '%$input%';
                ");

                //hier wordt gekeken hoeveel records er zijn ontvangen en wordt er berekend hoeveel paginas er nodig zijn
                $result = mysqli_query(dbConnectionRoot(), $queryRows);
                $numberOfResults = mysqli_num_rows($result);
                $numberOfPages = ceil($numberOfResults / $resultsPerPage);


                // onderstaande query wordt gebruikt om de benodigde data op te halen die geplaatst dient te worden in de product kaarten
                $query = ("SELECT si.StockItemID, StockItemName, Photo, MarketingComments, RecommendedRetailPrice, QuantityOnHand
                    FROM stockitems si
                    JOIN stockitemholdings sih ON sih.StockItemID = si.StockItemID
                    WHERE si.StockItemID LIKE '%$input%' OR SearchDetails LIKE '%$input%'
                    LIMIT $Offset, $resultsPerPage;
                ");

                $result = mysqli_query(dbConnectionRoot(), $query);

                showProductCards($result);

            }

            // met de onderstaande knoppen kan je naar de volgende pagina met Results gaan.
            // door $pageNumber aan te passen worden de waardes van de limit in de query aangepast zodat de juiste producten verstuurd worden
            // alle variablen worden hier weer in de link gezet anders kunnen deze niet meer gebruikt worden op de volgende pagina met Results
            print('<a  class="btn btn-primary" href="Results.php?cat='.$_GET["cat"].'&search='. $_GET["search"].'&select=' . $_GET["select"].'"> first </a>');
            print('<a  class="btn btn-primary" href="Results.php?cat='.$_GET["cat"].'&search='. $_GET["search"].'&select=' . $_GET["select"].'&pagenr=' . ($pageNumber -1). '"> prev </a>');
            print('<a  class="btn btn-primary" href="Results.php?cat='.$_GET["cat"].'&search='. $_GET["search"].'&select=' . $_GET["select"].'&pagenr=' . ($pageNumber +1). '"> next </a>');            
            print('<a  class="btn btn-primary" href="Results.php?cat='.$_GET["cat"].'&search='. $_GET["search"].'&select=' . $_GET["select"].'&pagenr=' . $numberOfPages. '"> last </a>');
            

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