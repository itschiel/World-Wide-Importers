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
FROM orders
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
mysqli_close($connection);
?>

<?php
// de onderstaande statement worden de bestellingen weergegeven
foreach ($_SESSION['cart'] as $product => $numberOf) {

    // data betreffend het product wordt opgehaald uit database
        $sql = ("SELECT StockItemName
        FROM stockitems
        WHERE StockItemID = $product");

    $result = mysqli_query(dbConnectionRoot(), $sql);
    $Item = mysqli_fetch_assoc($result);
    
    $ItemName = $Item['StockItemName'];
    $Order = "Aantal ".$numberOf."            Product ".$ItemName;

    // vooraad gaat af
    $sql = ("UPDATE stockitemholdings
    SET QuantityOnHand = QuantityOnHand - $numberOf
    WHERE StockItemID = $product");

    $result = mysqli_query(dbConnectionRoot(), $sql);

}

// mail bevestiginsmail naar klant

$sql = ("SELECT EmailAddress FROM customers
WHERE CustomerID = $CustomerID");

$result = mysqli_query(dbConnectionRoot(), $sql);
$EmailAddress = mysqli_fetch_assoc($result);


//$sql zit een query in om de gewenste waarde uit de database te halen
$mailOntvanger = $EmailAddress['EmailAddress'];
$subject ="Bestelling $OrderID";
$message = "Geachte heer/mevrouw\n\n Bedankt voor uw bestelling.\n 
Uw bestelling $OrderID staat hieronder ter bevastiging:\n
$Order\n
Met vriendeljike groet,\n\n
Wide-World-Importers";


mail($mailOntvanger,$subject,$message);

// verwijst door naar 'End.php'. Daarin wordt bevestigd aan de klant dat de bestelling geslaagd is.
header("Location: End.php");
?>