<html>

<header>
        <link rel="stylesheet" type="text/css" href="style.css">
    <title>WideWorldImporters</title>
</header>
<!-- Voegt de Header to aan de pagina -->
<?php
include 'Includes/Header.php';
include 'Functions/DBconnections.php';
?>

<body>

<h1>Popup/Modal Windows without JavaScript</h1>
<div class="box">
	<a class="button" href="#popup1">Let me Pop up</a>
</div>

<div id="popup1" class="overlay">
	<div class="popup">
		<h2>Here i am</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			Thank to pop me out of that button, but now i'm done so you can close this window.
		</div>
	</div>
</div>


<?php session_start();

echo "<pre>";
   print_r($_SESSION["cart"]);
echo "</pre>";

// $_SESSION["cart"] = array();

function showProductCards($result){

    // $resultCheck wordt gebruikt om te kijken of er daadwerkelijk een record is ontvangen
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)){
            productCard($row);
        }
    } else {
        print ("Er zijn geen resultaten gevonden.");
    }
}

function productCard($row) {

    // onderstaande statement kijkt of er een img in de database staat zo niet wordt de dafault image geladen
    if (empty($row['Photo'])) {

        $imgPath = ("img/defaultproduct.jpg");
        $imgBinary = fread(fopen($imgPath, "r"), filesize($imgPath));
        $img = base64_encode($imgBinary);

    } else {
        $img = base64_encode($row["Photo"]);
    }


    // onderstaande print statement plaatst de benodigde html op de pagina
    print('
        <a href="ProductPage.php?id='. $row["StockItemID"] . '" class="card mb-3" style="max-width: 80%;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="data:image/jpeg;base64,'. $img .'" class="card-img" style="object-fit: contain; max-height: 200px;">     
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">'. $row['StockItemName'] . '</h5>
                        <p class="card-text"> $'.$row['RecommendedRetailPrice'].'</p>
                        <p class="card-text"><small class="text-muted">Vooraad: '. $row['QuantityOnHand'] .' STK</small></p>
                    </div>
                </div>
            </div>
        </a>
    ');
}

foreach($_SESSION['cart'] as $productID => $amount) {
    $query = ("SELECT si.StockItemID, si.StockItemName, si.MarketingComments, si.SearchDetails, si.RecommendedRetailPrice, sh.QuantityOnHand, si.Photo
                FROM stockitems si
                JOIN stockitemstockgroups stg ON si.StockItemID = stg.StockItemID
                JOIN stockitemholdings sh ON sh.StockItemID = si.StockItemID
                WHERE StockGroupID = $productID
                  ");              
     $result = mysqli_query(dbConnectionRoot(), $query);
     showProductCards($result);

    
    //voor elk $productID in de array moet het desbetreffende product uit de database gehaald worden met de benodigde informatie
 }
?>
<!-- Voegt de Footer to aan de pagina -->
<?php include 'Includes/Footer.php';?>
</body>
</html>
