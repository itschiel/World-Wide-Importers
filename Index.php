<!doctype html>
<html lang="en">

    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>WorldWideImporters</title>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


        <!--Bootstrap javascript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <!-- Functie Includes -->
        <?php include_once 'Functions/DBConnections.php'; ?>
        <?php include 'Includes/Header.php';?>
        <?php include 'Functions/ProductResult.php'; ?>

    </head>

            <?php
            // Variabeleid haalt het id van het gezoken product  uit de url
            // $productID = $_GET['id'];

            $random = rand(1, 100);

            //$Result houd de waarde die de db terug stuurd aan de hand van de onderstaande query
            $query = ("SELECT s.StockItemName, s.MarketingComments, s.SearchDetails
                FROM stockitems s
                WHERE s.StockItemID = $random
                ");

            $result = mysqli_query(dbConnectionRoot(), $query); // dbConnectionRoot staat onder (Functions/dbconnections.php)
            $resultCheck = mysqli_num_rows($result);


            // Onderstaande if statement checkt of de db daadwerkelijk een record heeft terug gestuurd
            if($resultCheck > 0){
                // voor elke record in result wordt het onderstaande uitgevoerd
                while($row = mysqli_fetch_assoc($result)){

                    // onderstaande if else statement checkt of er een foto bij het product zit zo niet wordt de deafult image geladen
                    if (empty($row['Photo'])) {

                        $imgPath = ("Img/defaultProduct.jpg");
                        $imgBinary = fread(fopen($imgPath, "r"), filesize($imgPath));
                        $img = base64_encode($imgBinary);
                    
                    } else {
                        $img = base64_encode($row["Photo"]);
                    }
                    
                    // onderstaande print plaatst de benodigde html op de pagina
                    print("
                        <div class=\"container\">
                        <div class=\"col mx-auto\">
                        
                            <div class=\"container\">
                            <div class=\"row d-flex justify-content-center\">
                            <div class=\"row d-flex justify-content-center\">

                                                <div id=\"demo\" class=\"carousel slide\" data-ride=\"carousel\">

                                                <!-- Indicators -->
                                                <ul class=\"carousel-indicators\">
                                                <li data-target=\"#demo\" data-slide-to=\"0\" class=\"active\"></li>
                                                <li data-target=\"#demo\" data-slide-to=\"1\"></li>
                                                <li data-target=\"#demo\" data-slide-to=\"2\"></li>
                                                </ul>
                                            
                                                <!-- The slideshow -->
                                                <div class=\"carousel-inner\">
                                                <div class=\"carousel-item active\" class=\"col-md-2\">
                                                    <img src=\"img/christmassale.jpg\">
                                                </div>
                                                <div class=\"carousel-item\" class=\"col-md-2\">
                                                    <img src=\"img/10procentkorting.jpg\">
                                                </div>
                                                </div>
                                            
                                                <!-- Left and right controls -->
                                                <a class=\"carousel-control-prev\" href=\"#demo\" data-slide=\"prev\">
                                                <span class=\"carousel-control-prev-icon\"></span>
                                                </a>
                                                <a class=\"carousel-control-next\" href=\"#demo\" data-slide=\"next\">
                                                <span class=\"carousel-control-next-icon\"></span>
                                                </a>
                                            
                                                </div>
   

                            <div class=\"container\">
                            <div class=\"row d-flex justify-content-center\">
                            <div class=\"row d-flex justify-content-center\">
                                            <div class=\"col-sm-6\">
                                                <div class=\"card border-dark mb-3\">
                                                <div class=\"card-header\"> 
                                                <img class=\"w-25 p-3\" src=\"https://cdn.pixabay.com/photo/2013/07/13/11/53/best-seller-158885_960_720.png\">
                                                ". $row['StockItemName'] ."</div>
                                                <div class=\"card-body text-dark\">
                                                    <h5 class=\"card-title\">Productbeschrijving</h5>
                                                    <p class=\"card-text\">" . $row['SearchDetails']. "</p>
                                                    <a href=\"#\" class=\"btn btn-primary\">Naar productpagina</a>
                                                </div>
                                                </div>
                                            </div>
                                            ");
                                            }
                                            }
                                            ?>

            <?php
            // Variabeleid haalt het id van het gezoken product  uit de url
            // $productID = $_GET['id'];

            $random1 = rand(1, 100);

            //$Result houd de waarde die de db terug stuurd aan de hand van de onderstaande query
            $query = ("SELECT s.StockItemName, s.MarketingComments, s.SearchDetails
                FROM stockitems s
                WHERE s.StockItemID = $random1
                ");

            $result = mysqli_query(dbConnectionRoot(), $query); // dbConnectionRoot staat onder (Functions/dbconnections.php)
            $resultCheck = mysqli_num_rows($result);

            // Onderstaande if statement checkt of de db daadwerkelijk een record heeft terug gestuurd
            if($resultCheck > 0){
                // voor elke record in result wordt het onderstaande uitgevoerd
                while($row1 = mysqli_fetch_assoc($result)){

                    // onderstaande if else statement checkt of er een foto bij het product zit zo niet wordt de deafult image geladen
                    if (empty($row1['Photo'])) {

                        $imgPath = ("Img/defaultProduct.jpg");
                        $imgBinary = fread(fopen($imgPath, "r"), filesize($imgPath));
                        $img = base64_encode($imgBinary);
                    
                    } else {
                        $img = base64_encode($row1["Photo"]);
                    }
                    
                    // onderstaande print plaatst de benodigde html op de pagina
                    print("
                                            <div class=\"col-sm-6\">
                                                <div class=\"card border-dark mb-3\">
                                                <div class=\"card-header\"> 
                                                <img class=\"w-25 p-3\" src=\"https://cdn.pixabay.com/photo/2013/07/13/11/53/best-seller-158885_960_720.png\">
                                                ". $row1['StockItemName'] ."</div>
                                                <div class=\"card-body text-dark\">
                                                    <h5 class=\"card-title\">Productbeschrijving</h5>
                                                    <p class=\"card-text\">" . $row1['SearchDetails']. "</p>
                                                    <a href=\"#\" class=\"btn btn-primary\">Naar productpagina</a>
                                                </div>
                                                </div>
                                            </div>
                            </div>
                            </div>
                            </div>
                            
                        </div>
                        </div>
                        ");
                        }
                        }
            ?>

<!-- Voegt de Footer to aan de pagina -->
<?php include 'Includes/Footer.php';?>
</body>
</html>
