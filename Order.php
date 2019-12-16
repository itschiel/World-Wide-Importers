<?php
session_start();

include_once 'Functions/api.php';
include_once 'Functions/mollie.php';

// print_r($_SESSION['cart']);

// Haalt eenmalig databaseconnectie op uit 'unctions/DBConnections.php' een voert het connectie uit.
include_once 'Functions/DBConnections.php';
$connection = dbConnectionRoot();

// Controleerd of er connectie is met de database
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// in de statement worden de OrderID, $CustomerID (de ingelogde gebruiker) en Orderdate geregistreerd
$sql ="SELECT OrderID
FROM Orders
ORDER BY OrderID DESC
LIMIT 1";
$result = (mysqli_query($connection, $sql));
$row =  mysqli_fetch_object($result);

$OrderID = ($row->OrderID)+1;
$CustomerID = $_SESSION['CustomerID'];
$sql="INSERT INTO orders (OrderID,CustomerID) VALUES (?,?);";


$statement = mysqli_prepare($connection, $sql);
$statement->bind_param("ii",$OrderID,$CustomerID);
mysqli_stmt_execute($statement);


// de onderstaande statement lijst de producten uit
foreach ($_SESSION['cart'] as $product => $numberOf) {

    // data betreffend het product wordt opgehaald uit database
    $sql = (" SELECT *
        FROM stockitems
        WHERE StockItemID = $product
    ");
    
    $result = mysqli_query(dbConnectionRoot(), $sql);
    $row = mysqli_fetch_assoc($result);
}

// in de statement worden de OrderlineID, OrderID, StockIetemID en Orderdate geregistreerd
// $sql ="SELECT OrderLineID
// FROM orderlines
// ORDER BY OrderLineID DESC
// LIMIT 1";
// $result = (mysqli_query($connection, $sql));
// $row =  mysqli_fetch_object($result);

// $OrderLineID = ($row->OrderLineID)+1;
// $StockItemID = $product;
// $Quantity = $numberOf;

// $sql="INSERT INTO orderlines (OrderID,CustomerID,StockItemID,Quantity) VALUES (?,?,?,?);";


// $statement = mysqli_prepare($connection, $sql);
// $statement->bind_param("iiii",$OrderLineID,$OrderID,$StockItemID,$Quantity);
// mysqli_stmt_execute($statement);


// Vooraad gaat af van vooraad van bestelling
// $sql = ("stockitemholdings 
// SET QuantityOnHand = QuantityOnHand - $numberOf
// WHERE StockItemID = $StockItemID"); 


// mail bevestiginsmail naar klant

$sql = ("SELECT EmailAddress FROM customers
WHERE CustomerID = $CustomerID");

$result = mysqli_query(dbConnectionRoot(), $sql);
$values = mysqli_fetch_assoc($result);

$mailOntvanger = $values['EmailAddress'];
$subject ="Bestelling $OrderID";
$message = "Geachte heer/mevrouw\n\n Bedankt voor uw bestelling.\n 
Uw bestelling $OrderID staat hieronder ter bevastiging:\n
Aantal :$numberOf";


mail($mailOntvanger,$subject,$message);

mysqli_close($connection);
// verwijst door naar 'End.php'. Daarin wordt bevestigd aan de klant dat de bestelling geslaagd is.
header("Location: End.php");
?>