<?php
<<<<<<< HEAD
session_start();
?>
<?php

include_once 'Functions/api.php';
include_once 'Functions/mollie.php';

print_r($_SESSION['cart']);

=======
>>>>>>> 201e1baf3f3cb1013a872e669a41f7e5bbf47560
// Haalt eenmalig databaseconnectie op uit 'unctions/DBConnections.php' een voert het connectie uit.
include_once 'Functions/DBConnections.php';
$connection = dbConnectionRoot();

<<<<<<< HEAD

=======
>>>>>>> 201e1baf3f3cb1013a872e669a41f7e5bbf47560
// Controleerd of er connectie is met de database
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// in de statement worden de OrderID, CustomerID(de ingelogde gebruiker) en Orderdate geregistreerd

<<<<<<< HEAD
// $sql ="SELECT OrderID
// FROM Orders
// ORDER BY OrderID DESC
// LIMIT 1";
//  $result = (mysqli_query($connection, $sql));
//  $row =  mysqli_fetch_object($result);
//  $OrderID = ($row->OrderID)+1;
//  $CustomerID = $_SESSION['CustomerID'];
// $sql="INSERT INTO orders (OrderID,CustomerID) VALUES (?,?);";


// $statement = mysqli_prepare($connection, $sql);
// $statement->bind_param("ii",$OrderID,$CustomerID);
// mysqli_stmt_execute($statement);



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
$sql = "SELECT EmailAddress
FROM Customers 
WHERE CustomerID = $CustomerID;";
 $satement = mysqli_prepare($connection, $sql);

mysqli_stmt_bind_param($satement, "s", $email);
mysqli_stmt_execute($satement);
$result = mysqli_stmt_get_result($satement);


$mailOntvanger = "$statement";
$subject ="Bestelling";
$message = "Geachte heer/mevrouw\n\n Bedankt voor uw bestelling. Uw bestelling staat hieronder ter bevastiging:";


// mail($mailOntvanger,$subject,$message);

// verwijst door naar 'End.php'. Daarin wordt bevestigd aan de klant dat de bestelling geslaagd is.
//header("Location: End.php");
=======
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
$message = "Geachte heer/mevrouw\n\n Bedankt voor uw bestelling. Uw bestelling staat hieronder ter bevastiging:";


mail($mailOntvanger,$subject,$message);

// verwijst door naar 'End.php'. Daarin wordt bevestigd aan de klant dat de bestelling geslaagd is.
header("Location: End.php");
>>>>>>> 201e1baf3f3cb1013a872e669a41f7e5bbf47560
?>