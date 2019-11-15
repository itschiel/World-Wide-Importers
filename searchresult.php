<html>
<body>

<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "wideworldimporters";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

$sql = "
SELECT StockItemName, MarketingComments, SearchDetails, RecommendedRetailPrice, QuantityOnHand 
FROM stockitems s 
JOIN stockitemholdings sh ON sh.StockItemID = s.StockItemID 
WHERE SearchDetails like '%usb%';
";

$Result = mysqli_query($conn, $sql);
$Resultcheck = mysqli_num_rows($Result);

while ($Resultcheck > 0) {
    $Resultcheck--;
    print ( $Resultcheck.
    "
    <button style='width: 90%; max-height: 150px'>
        <div>
            <img src='https://www.bedrukken.nl/images/P/USB+stick+Twister-00.jpg' style='float: left; max-width: 25%; max-height: 125px;'>
            <h1> Product Naam </h1>
            <p> Lorem Ipsum is slechts en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren '60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.</p>
        </div>
    </button>
    <br>
    ");
}


//foreach ($row = mysqli_fetch_assoc($Result) as $key => $Value){
//    print ($key . "   " . $Value . "<br>");
//}



?>

</body>
</html>