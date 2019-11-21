<?php

function WeergevenProducten($Connection, $Query){
        
    $Result = mysqli_query($Connection, $Query);
    $Resultcheck = mysqli_num_rows($Result);
    $productnr = 0;
    $aantalproducten = 10;
    if ($Resultcheck > 0) {
<<<<<<< HEAD
        while ($productnr < $aantalproducten AND $row = mysqli_fetch_assoc($Result)){
            $productnr++;
            $Img = "https://rukminim1.flixcart.com/image/714/857/shirt/f/c/g/bfshtpc501rd-being-fab-40-original-imaecvnx9swvsvp5.jpeg?q=50";
=======
        while ($row = mysqli_fetch_assoc($Result)){
            
>>>>>>> 57f2ba2167c26166ff608c35b1cf7d11b3aa4462
            $Name = $row['StockItemName'];
            $Beschrijving = $row['MarketingComments'];
            $Prijs = $row['RecommendedRetailPrice'];
            $Vooraad = $row['QuantityOnHand'];
            $ID = $row['StockItemID'];
            
            if (empty($row['Photo'])){

                $Img = "https://cdn.cms-twdigitalassets.com/content/dam/blog-twitter/official/en_us/products/2017/rethinking-our-default-profile-photo/Avatar-Blog2-Round1.png.img.fullhd.medium.png";

                print('
                    <a href="ProductPreview.php?id='. $ID . '" class="card mb-3" style="max-width: 80%;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="'. $Img . '" class="card-img" style="object-fit: contain; max-height: 200px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">'. $Name . '</h5>
                                    <p class="card-text">'.$Beschrijving.'</p>
                                    <p class="card-text"> €'.$Prijs.'</p>
                                    <p class="card-text"><small class="text-muted">Vooraad: '. $Vooraad .' STK</small></p>
                                </div>
                            </div>
                        </div>
                    </a>
                ');

            } else {

                $Img = $row['Photo'];

                print('
                    <a href="ProductPreview.php?id='. $ID . '" class="card mb-3" style="max-width: 80%;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="data:image/jpeg;base64,'. base64_encode($Img).'" class="card-img" style="object-fit: contain; max-height: 200px;">     
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">'. $Name . '</h5>
                                    <p class="card-text">'.$Beschrijving.'</p>
                                    <p class="card-text"> €'.$Prijs.'</p>
                                    <p class="card-text"><small class="text-muted">Vooraad: '. $Vooraad .' STK</small></p>
                                </div>
                            </div>
                        </div>
                    </a>
                ');
            }
        }
    } else {
        print ("Er zijn geen resultaten gevonden.");
    }
}

?>
