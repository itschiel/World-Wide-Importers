<?php

// onderstaande functie plaatst voor elke record die uit de database komt een product kaart
function WeergevenProducten($Result){

    // $Resultcheck wordt gebruikt om te kijken of er daadwerkelijk een record is ontvangen
    $Resultcheck = mysqli_num_rows($Result);

    if ($Resultcheck > 0) {
        while ($row = mysqli_fetch_assoc($Result)){
            productKaart($row);
        }
    } else {
        print ("Er zijn geen resultaten gevonden.");
    }
}

// onderstaande functie plaatst een proct tegel op basis van de aangeleverde array
function productKaart($row) {

    // onderstaande statement kijkt of er een img in de database staat zo niet wordt de dafault image geladen
    if (empty($row['Photo'])) {

        $img_path = ("img/defaultproduct.jpg");
        $img_binary = fread(fopen($img_path, "r"), filesize($img_path));
        $img = base64_encode($img_binary);

    } else {
        $img = base64_encode($row["Photo"]);
    }


    // onderstaande print statement plaatst de benodigde html op de pagina
    print('
        <a href="ProductPagina.php?id='. $row["StockItemID"] . '" class="card mb-3" style="max-width: 80%;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="data:image/jpeg;base64,'. $img .'" class="card-img" style="object-fit: contain; max-height: 200px;">     
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">'. $row['StockItemName'] . '</h5>
                        <p class="card-text">'.$row['MarketingComments'].'</p>
                        <p class="card-text"> $'.$row['RecommendedRetailPrice'].'</p>
                        <p class="card-text"><small class="text-muted">Vooraad: '. $row['QuantityOnHand'] .' STK</small></p>
                    </div>
                </div>
            </div>
        </a>
    ');
}

?>
