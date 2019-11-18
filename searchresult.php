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
WHERE SearchDetails like '%shirt%';
";

$Result = mysqli_query($conn, $sql);
$Resultcheck = mysqli_num_rows($Result);

if ($Resultcheck > 0) {
    while ($row = mysqli_fetch_assoc($Result)){
        print ("
        <button style='width: 90%; max-height: 150px;'>
            <div>
                <img src='https://www.nomadfoods.com/wp-content/uploads/2018/08/placeholder-1-e1533569576673-960x960.png' style='float: left; max-width: 25%; max-height: 125px;'>
                <h1> ". $row['StockItemName'] ." </h1>
                <p> ". $row['MarketingComments'] . "<P>
            </div>
        </button>
        ");
    }
}


//foreach ($row = mysqli_fetch_assoc($Result) as $key => $Value){
//    print ($key . "   " . $Value . "<br>");
//}



?>

</body>
</html>