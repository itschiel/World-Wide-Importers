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
    <?php include 'Functions/dbconnections.php'; ?>

</head>
<body>

<?php include 'Includes/header.php';  ?>

<?php

$variabeleid = $_GET['id'];

$sql = ("SELECT s.StockItemName, s.RecommendedRetailPrice, s.MarketingComments, s.Photo, s.SearchDetails, h.QuantityOnHand
    FROM stockitems s
    JOIN stockitemholdings h ON s.StockItemID = h.StockItemID
    WHERE s.StockItemID = $variabeleid
    ");

$result = dbConnectionRoot($sql);
$resultcheck = mysqli_num_rows($result);

if($resultcheck > 0){
    while($row = mysqli_fetch_assoc($result)){

        if (empty($row['Photo'])) {

            $img_path = ("img/defaultproduct.jpg");
            $img_binary = fread(fopen($img_path, "r"), filesize($img_path));
            $img = base64_encode($img_binary);
        
        } else {
            $img = base64_encode($row["Photo"]);
        }
        
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
                                    <h1 class=\"card-title pricing-card-title\">". $row['RecommendedRetailPrice'] ."</h1>
                                    <ul class=\"list-unstyled mt-3 mb-4\">
                                        <li>". $row['QuantityOnHand'] ." stuk(s) voorradig</li>
                                        <br><br><br><br><br><br>
                                    </ul>
                                    <button type=\"button\" class=\"btn btn-lg btn-block btn-outline-primary\">In winkelmand</button>
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

<?php include 'Includes/footer.php';  ?>

</body>
</html>