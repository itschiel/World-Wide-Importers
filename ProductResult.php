<?php

function WeergevenProducten($Result){

    $Resultcheck = mysqli_num_rows($Result);

    if ($Resultcheck > 0) {
        while ($row = mysqli_fetch_assoc($Result)){
            productKaart($row);
        }
    } else {
        print ("Er zijn geen resultaten gevonden.");
    }
}

function productKaart($row) {

    if (empty($row['Photo'])) {

        $img_path = ("img/defaultproduct.jpg");
        $img_binary = fread(fopen($img_path, "r"), filesize($img_path));
        $img = base64_encode($img_binary);

    } else {
        $img = base64_encode($row["Photo"]);
    }

    print('
        <a href="ProductPreview.php?id='. $row["StockItemID"] . '" class="card mb-3" style="max-width: 80%;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="data:image/jpeg;base64,'. $img .'" class="card-img" style="object-fit: contain; max-height: 200px;">     
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">'. $row['StockItemName'] . '</h5>
                        <p class="card-text">'.$row['MarketingComments'].'</p>
                        <p class="card-text"> €'.$row['RecommendedRetailPrice'].'</p>
                        <p class="card-text"><small class="text-muted">Vooraad: '. $row['QuantityOnHand'] .' STK</small></p>
                    </div>
                </div>
            </div>
        </a>
    ');
}

?>
