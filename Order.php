<?php
session_start();
?>
<?php

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



//-----------------------------------------------------------

// $sql ="SELECT OrderLineID
// FROM Orderlines
// ORDER BY OrderLineID DESC
// LIMIT 1";
// $result = (mysqli_query($connection, $sql));
// $row =  mysqli_fetch_object($result);
// $OrderLineID = ($row->OrderLineID)+1;
// $StockItemID = $product;
// $sql="INSERT INTO orders (OrderID,CustomerID) VALUES (?,?,?);";


// $statement = mysqli_prepare($connection, $sql);
// $statement->bind_param("iii",$OrderLineID,$OrderID,$StockItemID);
// mysqli_stmt_execute($statement);

mysqli_close($connection);

//-----------------------------------------------------------


// mail bevestiginsmail naar klant
$Cart = $_SESSION['cart'];
$sql = "SELECT EmailAddress
FROM Customers WHERE CustomerID = $CustomerID;";
$satement = mysqli_prepare($connection, $sql);

$result= mysqli_query(dbConnectionRoot(), $sql);

while ($rows = mysqli_fetch_assoc($result){
    print ($rows['EmailAddress']);    
}

$mailOntvanger = $rows['EmailAddress'];;
$subject ="Bestelling";
$message = "Geachte heer/mevrouw\n\n Bedankt voor uw bestelling.\n 
Uw bestelling staat hieronder ter bevastiging:\n";


mail($mailOntvanger,$subject,$message);

// verwijst door naar 'End.php'. Daarin wordt bevestigd aan de klant dat de bestelling geslaagd is.
header("Location: End.php");
?>