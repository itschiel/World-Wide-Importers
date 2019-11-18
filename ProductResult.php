<?php

function ProductResult($Img, $Name, $Beschrijving, $Prijs, $Vooraad){
    print('
    <div class="card mb-3" style="max-width: 80%;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src='.$Img.' class="card-img" style="object-fit: contain; max-height: 200px;">
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
    </div>
    '
    );
}

?>
