<html>

<header>
        
    <title>WideWorldImporters</title>
</header>
<!-- Voegt de Header to aan de pagina -->
<?php
include 'Includes/Header.php';
include_once 'Functions/DBconnections.php';
?>

<body>

<?php session_start();

echo "<pre>";
   print_r($_SESSION["cart"]);
echo "</pre>";

//$_SESSION["cart"] = array();

$query = ("SELECT si.stockItemName 
                FROM stockitems si
                WHERE StockItemID = $productID
                  ");  


foreach($_SESSION['cart'] as $productID => $amount) {
    $result = mysqli_query(dbConnectionRoot(), $query);
    
    //voor elk $productID in de array moet het desbetreffende product uit de database gehaald worden met de benodigde informatie
 }
?>
<!-- Voegt de Footer to aan de pagina -->
<?php include 'Includes/Footer.php';?>
</body>
</html>
