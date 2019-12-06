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

    </head>

    <body>

        <!-- Voegt de Header to aan de pagina -->
        <?php
        session_start();

        if(empty($_SESSION["cart"])){
            $_SESSION["cart"] = array(); 
        }

        function addToCart ($id, $amount){
            $_SESSION['cart'][$id] = $amount;
        }
        include 'Includes/Header.php';  
        ?>


        <?php

        if(isset($_GET["winkelwagen"])){
            addToCart($_GET["id"], 1);
        }   

            // Variabeleid haalt het id van het gezoken product  uit de url
            $ProductID = $_GET['id'];

            //$Result houd de waarde die de db terug stuurd aan de hand van de onderstaande query
            $query = ("SELECT s.StockItemName, s.RecommendedRetailPrice, s.MarketingComments, s.SearchDetails, h.QuantityOnHand
                FROM stockitems s
                JOIN stockitemholdings h ON s.StockItemID = h.StockItemID
                WHERE s.StockItemID = $ProductID
                ");

            $result = mysqli_query(dbConnectionRoot(), $query); // dbConnectionRoot staat onder (Functions/dbconnections.php)
            $resultCheck = mysqli_num_rows($result);


            // Onderstaande if statement chekct of de db daadwerkelijk een record heeft terug gestuurd
            if($resultCheck > 0){
                // voor elke record in result wordt het onderstaande uitgevoerd
                while($row = mysqli_fetch_assoc($result)){

                    // onderstaande if else statement checkt of er een foto bij het product zit zo niet wordt de deafult image geladen
                    if (empty($row['foto'])) {

                        $imgPath = ("Img/defaultProduct.jpg");
                        $imgBinary = fread(fopen($imgPath, "r"), filesize($imgPath));
                        $img = base64_encode($imgBinary);

                    } else {
                        $img = base64_encode($row["foto"]);
                    }



                    // onderstaande print plaatst de benodigde html op de pagina
                    print('
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="container" style="margin-top:30px">
                                        <div class="row">
                                            <div class="col-sm">
                                                <h2>PRODUCTNAAM: '. $row["StockItemName"] .'</h2>
                                                <h6>Review systeem in sterren moet hier komen</h6>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="thumbnail">
                                                            <a href="img/defaultproduct.jpg">
                                                            ');

                                                            allImages();

                                                            print ('
                                                                <div class="caption">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <p class="font-weight-bold">Productinformatie: </p>
                                                <p>' . $row["MarketingComments"]. '</p>
                                                <p class="font-weight-bold">Productbeschrijving: </p>
                                                <p>'. $row["SearchDetails"] .'</p>
                                                <p class="font-weight-bold">Video: </p>
                                                <p>Link naar het filmmateriaal van het product: <a href="video.html">Klik hier</a> </p>
                                            </div>
                                            <div class="card border-dark mb-3" style="max-width: 18rem">
                                                <div class="card-header">
                                                <h4 class="my-0 font-weight-normal">Prijs</h4>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title pricing-card-title">$'. $row["RecommendedRetailPrice"] .'</h1>
                                                <ul class="list-unstyled mt-3 mb-4">
                                                    <li>'. $row["QuantityOnHand"] .' stuk(s) voorradig</li>
                                                    <br><br><br><br><br><br>
                                                </ul>
                                                <a class="btn btn-lg btn-block btn-outline-primary" href="ProductPage.php?winkelwagen=true&knoppie=true&id='.$_GET['id'].'">in winkelmand</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                ');
                }
            }

            
            function allImages(){

                $productID = $_GET['id'];
                $query = ("SELECT foto
                FROM productimages
                WHERE productid =  $productID
                ");

                $result = mysqli_query(dbConnectionRoot(), $query); // dbConnectionRoot staat onder (Functions/dbconnections.php)
                $resultCheck = mysqli_num_rows($result);

                while($row = mysqli_fetch_assoc($result)){
                    $img = base64_encode($row["foto"]);
                    echo ('<img src="data:image/jpeg;base64,'. $img .' " alt="Lights" style="width:100%">');
                }
            }
        ?>

        <!-- Voegt de Footer to aan de pagina -->
        <?php include 'Includes/Footer.php';  ?>

        <?php

        if(isset($_GET["knoppie"])){

        }
        ?>
    </body>

</html>