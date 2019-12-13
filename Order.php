<?php
// Haalt eenmalig databaseconnectie op uit 'unctions/DBConnections.php' een voert het connectie uit.
include_once 'Functions/DBConnections.php';
$connection = dbConnectionRoot();

// Controleerd of er connectie is met de database
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// in de statement worden de OrderID, CustomerID(de ingelogde gebruiker) en Orderdate geregistreerd

$statement = $connection->prepare("INSERT INTO orders (CustomerID) VALUES (?);");
$statement->bind_param("i",$CustomerID);

$CustomerID =1000;
$statement->execute();


$statement = $connection->prepare("INSERT INTO orderlines (OrderID,StockItemID,Description,Quantity) VALUES (?,?,?,?);");
$statement->bind_param("iisi",$OrderID,$StockItemID,$Description,$Quantity);

$OrderID = 4;
$StockItemID = 4;
$Description = "Placeholder";
$Quantity = 4;
$statement->execute();

$statement->close();
$connection->close();



// mail bevestiginsmail naar klant
$mailOntvanger = "s1143071@student.windesheim.nl";
$subject ="Bestelling $OrderID";
$message = "Geachte heer/mevrouw\n\n Bedankt voor uw bestelling. Uw bestelling staat hieronder ter bevastiging;:";


mail($mailOntvanger,$subject,$message);

// verwijst door naar 'End.php'. Daarin wordt bevestigd aan de klant dat de bestelling geslaagd is.
header("Location: End.php");
?>