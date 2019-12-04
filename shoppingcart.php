<html>

<header>
    <title>WideWorldImporters</title>
</header>
<!-- Voegt de Header to aan de pagina -->
<?php
include 'Includes/Header.php'; 
?>

<body>

<?php session_start();  

echo "<pre>";
   print_r($_SESSION["cart"]);
echo "</pre>";

// $_SESSION["cart"] = array();

//  $query = ("SELECT s.StockItemName 
//                  FROM stockitems s
//                  WHERE s.StockItemID = $productID
//                  ");

foreach($_SESSION['cart'] as $productID => $amount) {
     
    //voor elk $productID in de array moet het desbetreffende product uit de database gehaald worden met de benodigde informatie
 }
?>
<!-- Voegt de Footer to aan de pagina -->
<?php include 'Includes/Footer.php';?>
</body>
</html>
