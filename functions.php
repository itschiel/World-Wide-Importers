<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$port = 3306;
$databasename = "wideworldimporters";
$connection = mysqli_connect($host, $user, $pass, $databasename);

function items($connection)
{
    $sql = "SELECT StockItemName, StockGroupName 
            FROM stockitems s
            JOIN stockitemstockgroups g ON s.StockItemID = g.StockItemID
            JOIN stockgroups t ON g.StockGroupID = t.StockGroupID";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $naam = $row["StockItemName"];
        $group = $row["StockGroupName"];
        print($naam . " " . $group . "<br>");
    }
}
?>