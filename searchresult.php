<html>

<header>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <?php include 'ProductResult.php'; ?>
</header>

<body>

<form method="get">
    <input name="search" type="text">
    <button name="submite" type="submit">Lego!</button>
</form>

<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "wideworldimporters";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (isset ($_GET['search'])){
    $Input = $_GET['search'];

    $sql = "
    SELECT StockItemName, MarketingComments, SearchDetails, RecommendedRetailPrice, QuantityOnHand 
    FROM stockitems s 
    JOIN stockitemholdings sh ON sh.StockItemID = s.StockItemID 
    WHERE SearchDetails like '%$Input%';
    ";

    $Result = mysqli_query($conn, $sql);
    $Resultcheck = mysqli_num_rows($Result);

    if ($Resultcheck > 0) {
        while ($row = mysqli_fetch_assoc($Result)){

            $Img = "https://www.bedrukken.nl/images/P/USB+stick+Twister-00.jpg";
            $Name = $row['StockItemName'];
            $Beschrijving = $row['MarketingComments'];
            $Prijs = $row['RecommendedRetailPrice'];
            $Vooraad = $row['QuantityOnHand'];

            ProductResult($Img, $Name, $Beschrijving, $Prijs, $Vooraad);
        }
    }
}

?>

</body>
</html>