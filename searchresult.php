<html>

<header>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <?php include 'ProductResult.php'; ?>
</header>

<body>
    
<?php include 'Includes/Header.php'?>

<?php

if (isset ($_GET['search'])){
    $Input = $_GET['search'];

    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "wideworldimporters";

    $connection = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    $query = "
    SELECT s.StockItemID, StockItemName, MarketingComments, SearchDetails, RecommendedRetailPrice, QuantityOnHand, s.Photo
    FROM stockitems s 
    JOIN stockitemholdings sh ON sh.StockItemID = s.StockItemID 
    WHERE s.StockItemID LIKE '%$Input%'  OR SearchDetails LIKE '%$Input%';
    ";

    WeergevenProducten($connection, $query);

} elseif (isset($_GET['cat'])) {

    $Input = $_GET['cat'];

    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "wideworldimporters";

    $connection = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    $query = "SELECT si.StockItemID, si.StockItemName, si.MarketingComments, si.SearchDetails, si.RecommendedRetailPrice, sh.QuantityOnHand, si.Photo
    FROM stockitems si
    JOIN stockitemstockgroups stg ON si.StockItemID = stg.StockItemID
    JOIN stockitemholdings sh ON sh.StockItemID = si.StockItemID
    WHERE StockGroupID = '".$Input."';";

    WeergevenProducten($connection, $query);
}

?>

<?php include 'Includes/Footer.php'?>

</body>
</html>