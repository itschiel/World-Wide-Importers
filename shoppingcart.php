<html>

<header>
    <title>WideWorldImporters</title>
</header>

<?php
include 'Includes/Header.php'; 
?>

<div>
    <a href="shoppingcart.php">clear cart</a>
</div>  

<body>

<!-- Voegt de Header to aan de pagina -->
<?php session_start();

$productID = $_GET['id'];

echo "<pre>";
   print_r($_SESSION["cart"]);
echo "</pre>";

//var_dump($_SESSION["cart"]);

 $query = ("SELECT s.StockItemName 
                 FROM stockitems s
                 WHERE s.StockItemID = $productID
                 ");

foreach($_SESSION as $key => $productID) {
    //voor elk $productID in de array moet het desbetreffende product uit de database gehaald worden met de benodigde informatie
}
?>
<!-- Voegt de Footer to aan de pagina -->
<?php include 'Includes/Footer.php';?>
</body>
</html>
