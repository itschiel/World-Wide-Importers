<html>

<header>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <?php include 'ProductResult.php'; ?>
</header>

<body>
<?php

if (isset ($_GET['search'])){
    $Input = $_GET['search'];

    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "wideworldimporters";

    $connection = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    $query = "
    SELECT s.StockItemID, StockItemName, MarketingComments, SearchDetails, RecommendedRetailPrice, QuantityOnHand 
    FROM stockitems s 
    JOIN stockitemholdings sh ON sh.StockItemID = s.StockItemID 
    WHERE SearchDetails like '%$Input%';
    ";

    WeergevenProducten($connection, $query);

} elseif (isset($_GET['cat'])) {

    $Input = $_GET['cat'];

    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "wideworldimporters";

    $connection = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    $query = "
    SELECT s.StockItemID, StockItemName, MarketingComments, SearchDetails, RecommendedRetailPrice, QuantityOnHand 
    FROM stockitems s 
    JOIN stockitemholdings sh ON sh.StockItemID = s.StockItemID 
    WHERE ....;
    ";

    WeergevenProducten($connection, $query);
}

?>

</body>
</html>