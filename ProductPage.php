<!doctype html>
<html lang="en">

    <head>

        <title>WorldWideImporters</title>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Functie Includes -->
        <?php include 'Functions/DBConnections.php'; ?>

    </head>

    <body>

        <!-- Voegt de Header to aan de pagina -->
        <?php
        include 'Includes/Header.php';  
        ?>



        <?php

            // Variabeleid haalt het id van het gezoken product  uit de url
            $productID = $_GET['id'];

            //$Result houd de waarde die de db terug stuurd aan de hand van de onderstaande query
            $query = ("SELECT s.StockItemName, s.RecommendedRetailPrice, s.MarketingComments, s.Photo, s.SearchDetails, h.QuantityOnHand
                FROM stockitems s
                JOIN stockitemholdings h ON s.StockItemID = h.StockItemID
                WHERE s.StockItemID = $productID
                ");

            $result = mysqli_query(dbConnectionRoot(), $query); // dbConnectionRoot staat onder (Functions/dbconnections.php)
            $resultCheck = mysqli_num_rows($result);


            // Onderstaande if statement chekct of de db daadwerkelijk een record heeft terug gestuurd
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
                        <div class=\"container-fluid\">
                            <div class=\"row\">
                                <div class=\"col-lg\">
                                    <div class=\"container\" style=\"margin-top:30px\">
                                        <div class=\"row\">
                                            <div class=\"col-sm\">
                                                <h2>PRODUCTNAAM: ". $row['StockItemName'] ."</h2>
                                                <h6>Review systeem in sterren moet hier komen</h6>
                                                <div class=\"row\">
                                                    <div class=\"col-md-4\">
                                                        <div class=\"thumbnail\">
                                                            <a href=\"img/defaultproduct.jpg\">
                                                                <img src=\"data:image/jpeg;base64, $img \" alt=\"Lights\" style=\"width:100%\">
                                                                <div class=\"caption\">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class=\"col-md-4\">
                                                        <div class=\"thumbnail\">
                                                            <a href=\"img/defaultproduct.jpg\">
                                                            <img src=\"data:image/jpeg;base64, $img \" alt=\"Lights\" style=\"width:100%\">
                                                                <div class=\"caption\">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <p class=\"font-weight-bold\">Productinformatie: </p>
                                                <p>" . $row['MarketingComments']. "</p>
                                                <p class=\"font-weight-bold\">Productbeschrijving: </p>
                                                <p>". $row['SearchDetails'] ."</p>
                                                <p class=\"font-weight-bold\">Video: </p>
                                                <p>Link naar het filmmateriaal van het product: <a href=\"video.html\">Klik hier</a> </p>
                                            </div>
                                            <div class=\"card border-dark mb-3\" style=\"max-width: 18rem\">
                                                <div class=\"card-header\">
                                                <h4 class=\"my-0 font-weight-normal\">Prijs</h4>
                                            </div>
                                            <div class=\"card-body\">
                                                <h1 class=\"card-title pricing-card-title\">$". $row['RecommendedRetailPrice'] ."</h1>
                                                <ul class=\"list-unstyled mt-3 mb-4\">
                                                    <li>". $row['QuantityOnHand'] ." stuk(s) voorradig</li>
                                                    <br><br><br><br><br><br>
                                                </ul>
                                                <a class='btn btn-default' href='add-to-cart.php?id=$productID'>In Winkelmand</a>
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
        <?php include 'Includes/Footer.php';  ?>

    </body>

</html>