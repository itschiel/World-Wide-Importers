<?php include 'header.php';  ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>WorldWideImporters</title>

</head>
<body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "wideworldimporters";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

$random = rand(1,6);

$variabeleid = $_GET['number'];

$sql = "SELECT s.StockItemID, s.StockItemName, s.Brand, s.QuantityPerOuter, s.UnitPrice, s.RecommendedRetailPrice, s.TypicalWeightPerUnit, s.MarketingComments, s.Photo, s.CustomFields, s.Tags, s.SearchDetails, h.QuantityOnHand FROM stockitems AS s JOIN stockitemholdings AS h ON s.StockItemID = h.StockItemID WHERE s.StockItemID = '".$variabeleid."'  ORDER BY s.StockItemID ";

$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);

if($resultcheck > 0){
    while($row = mysqli_fetch_assoc($result)){
        $StockItemID = $row['StockItemID'];
        $StockItemName = $row['StockItemName'];
        $Brand = $row['Brand'];
        $QuantityPerOuter = $row['QuantityPerOuter'];
        $UnitPrice = $row['UnitPrice'];
        $RecommendedRetailPrice = $row['RecommendedRetailPrice'];
        $TypicalWeightPerUnit = $row['TypicalWeightPerUnit'];
        $MarketingComments = $row['MarketingComments'];
        $Photo = $row['Photo'];
        $CustomFields = $row['CustomFields'];
        $Tags = $row['Tags'];
        $SearchDetails = $row['SearchDetails'];
        $QuantityOnHand = $row['QuantityOnHand'];
        print("
        <div class=\"container-fluid\">
            <div class=\"row\">
                <div class=\"col-lg\">
                    <div class=\"container\" style=\"margin-top:30px\">
                        
                        <div class=\"row\">
                            <div class=\"col-sm\">
                                <h2>PRODUCTNAAM: ". $StockItemName ."</h2>
                                <h6>Review systeem in sterren moet hier komen</h6>

                                                <div class=\"row\">
                                                <div class=\"col-md-4\">
                                                <div class=\"thumbnail\">
                                                    <a href=\"Default_Image.png\">
                                                    <img src=\"Default_Image.png\" alt=\"Lights\" style=\"width:100%\">
                                                    <div class=\"caption\">
                                                    </div>
                                                    </a>
                                                </div>
                                                </div>
                                                <div class=\"col-md-4\">
                                                <div class=\"thumbnail\">
                                                    <a href=\"Default_Image.png\">
                                                    <img src=\"Default_Image.png\" alt=\"Nature\" style=\"width:100%\">
                                                    <div class=\"caption\">
                                                    </div>
                                                    </a>
                                                </div>
                                                </div>
                                                </div>

                                    <br>

                                    <p class=\"font-weight-bold\">Productinformatie: </p>
                                    <p>$MarketingComments</p>
                                    <p class=\"font-weight-bold\">Productbeschrijving: </p>
                                    <p>$$SearchDetails</p>
                                    <p class=\"font-weight-bold\">Video: </p>
                                    <p>Link naar het filmmateriaal van het product: <a href=\"video.html\">Klik hier</a> </p>
                                </div>

                                <div class=\"card border-dark mb-3\" style=\"max-width: 18rem\">
                                    <div class=\"card-header\">
                                    <h4 class=\"my-0 font-weight-normal\">Prijs</h4>
                                </div>
                                <div class=\"card-body\">
                                    <h1 class=\"card-title pricing-card-title\">$RecommendedRetailPrice</h1>
                                    <ul class=\"list-unstyled mt-3 mb-4\">
                                    <li>Voorraad: $QuantityOnHand</li>
                                    <br><br><br><br><br><br>
                                    </ul>
                                    <button type=\"button\" class=\"btn btn-lg btn-block btn-outline-primary\">In winkelmand</button>
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
</body>
</html>
<?php include 'footer.php';  ?>