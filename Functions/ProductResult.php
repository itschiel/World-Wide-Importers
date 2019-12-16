<?php

// onderstaande functie plaatst voor elke record die uit de database komt een product kaart
function showProductCards($result){

    // $resultCheck wordt gebruikt om te kijken of er daadwerkelijk een record is ontvangen
    $resultCheck = mysqli_num_rows($result);

    include_once "Functions/api.php";
    $rate = USDToEUR();

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)){
            productCard($row, $rate);
        }
    } else {
        print ("Er zijn geen resultaten gevonden.<br>");
    }
}

// onderstaande functie plaatst een proct tegel op basis van de aangeleverde array
function productCard($row, $rate) {

    $img = getFirstPhoto($row['StockItemID']);


    // onderstaande print statement plaatst de benodigde html op de pagina
    print('
        <div class="row no-gutters">
            <div class="col-md-4">
                <a href="ProductPage.php?id='. $row["StockItemID"] . '">
                    <img src="data:image/jpeg;base64,'. $img .'" class="card-img" style="object-fit: contain; max-height: 200px;">
                </a>  
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <a href="ProductPage.php?id='. $row["StockItemID"] . '">
                        <h5 class="card-title">'. $row['StockItemName'] . '</h5>
                    </a>
                    <p class="card-text">'.$row['MarketingComments'].'</p>
                    <p class="card-text"> €'.round(($rate * $row['RecommendedRetailPrice']), 2).'</p>
                    <p class="card-text"><small class="text-muted">Vooraad: '. $row['QuantityOnHand'] .' STK</small></p>
                </div>
            </div>
        </div>
        <br>
    ');
}

function getFirstPhoto($productID){

    // onderstaande query haalt de eerste foto van een product op
    $query = ("SELECT foto
        FROM productimages
        WHERE productid = $productID
        LIMIT 1
        ");

    $connection = dbConnectionRoot();
    $result = mysqli_query($connection, $query);
    $resultCheck = mysqli_num_rows($result);

    // onderstaande statement kijkt of er een img in de database staat zo niet wordt de dafault image geladen
    if ($resultCheck > 0) {

        // dit is de foto uit de database
        $row = mysqli_fetch_assoc($result);
        $img = base64_encode($row["foto"]);

    } else {

        // dit is de opgegeven deafult image
        $imgPath = ("img/defaultproduct.jpg");
        $imgBinary = fread(fopen($imgPath, "r"), filesize($imgPath));
        $img = base64_encode($imgBinary);

    }

    mysqli_close($connection);

    return $img;

}

?>
