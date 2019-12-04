<html>

<header>
    <title>WideWorldImporters</title>
</header>

<body>
<!-- Voegt de Header to aan de pagina -->
<?php 
session_start();

if(empty($_SESSION["cart"])){
    $_SESSION["cart"] = array(); 
}

array_push($_SESSION["cart"], $_GET["id"]);

function addToCart ($id, $aantal){
    $_SESSION['cart'][$id] = $aantal;
}

include 'Includes/Header.php';?>

<p>
Product was successfully added to your cart.
<a href="shoppingcart.php">view Shopping cart</a>
</p>

<!-- Voegt de Footer to aan de pagina -->
<?php include 'Includes/Footer.php';?>
</body>
</html>
