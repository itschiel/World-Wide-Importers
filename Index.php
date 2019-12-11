<html>

<header>
    <title>WideWorldImporters</title>
</header>

<body>
<!-- Voegt de Header to aan de pagina -->
<?php include 'Includes/Header.php';?>
<?php 
if(isset($_SESSION['CustomerId'])){
print($_SESSION['CustomerID']); 
}
?>



<!-- Voegt de Footer to aan de pagina -->
<?php include 'Includes/Footer.php';?>
</body>
</html>
