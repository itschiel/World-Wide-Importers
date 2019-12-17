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
        <?php include_once 'Functions/api.php'; ?>

    </head>

    <body>

        <!-- Voegt de Header to aan de pagina -->
        <?php

        if(empty($_SESSION["cart"])){
            $_SESSION["cart"] = array(); 
        }

        function addToCart ($id, $amount){
            $_SESSION['cart'][$id] = $amount;
        }
        include 'Includes/Header.php';  
        ?>


        <?php
        //de querry voor de voorraad conversieverhogende maatregel
        //de querry voor de koelstatus van het product
        $ProductID1 = $_GET['id'];
        $op = ("SELECT h.QuantityOnHand, s.IsChillerStock
        FROM stockitems s
        JOIN stockitemholdings h ON s.StockItemID = h.StockItemID
        WHERE s.StockItemID = $ProductID1
        ");
        $result = mysqli_query(dbConnectionRoot(), $op); 
        $resultCheck = mysqli_num_rows($result);
        $row =  mysqli_fetch_object($result);
        $QuantityOnHand = ($row->QuantityOnHand);
        $IsChillerStock = ($row->IsChillerStock);        

        if(isset($_GET["winkelwagen"])){
            addToCart($_GET["id"], 1);
        }   

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
                        <div class="container shadow" style="margin-top: 25px;">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="container" style="margin-top:30px">
                                        <div class="row">
                                            <div class="col-sm">
                                                <h2>'. $row["StockItemName"] .'</h2>
                                                <div class="row">
                                                    <div class="col-md-7">
                    ');

                    include "Includes/imgCarousel.php";
                    
                    print('
                                                    </div>  
                                                </div>
                                                <br>
                                                <p class="font-weight-bold">Productinformatie: </p>
                                                <p>' . $row["MarketingComments"]. '</p>
                                                <p class="font-weight-bold">Productbeschrijving: </p>
                                                <p>'. $row["SearchDetails"] .'</p>
                                                <p class="font-weight-bold">Koelstatus: </p>
                                                ');?>
                                                <?php
                                                if($IsChillerStock == "1"){
                                                    print("Wel koud");
                                                }else{
                                                    print("Niet koud");
                                                }
                                                print('
                                                
                                            </div>
                                        

                                            <div class="card border-dark mb-3" style="max-width: 18rem">
                                                <div class="card-header">
                                                <h4 class="my-0 font-weight-normal" >Prijs</h4>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="text-success">€'. round(($row["RecommendedRetailPrice"] * USDToEUR()),2) .'</h1>
                                                <ul class="list-unstyled mt-3 mb-4">
                                                    <li>'. $row["QuantityOnHand"] .' stuk(s) voorradig</li>
                                                </ul>
                                                ');?>
                                                <?php
                                                if($QuantityOnHand < 1000){
                                                    print("<img class=\"w-75 p-3\" src=\"img\op=op.jpg\">");
                                                }
                                                print('
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

        ?>

        <!-- Voegt de Footer to aan de pagina -->
        <?php include 'Includes/Footer.php';  ?>

        <?php

        if(isset($_GET["knoppie"])){

        }
        ?>
    </body>

</html>
