<html>

<header>

    <?php include_once 'Functions/DBconnections.php'; ?>
    <?php include_once 'Functions/api.php'; ?>
    <?php include_once "Functions/mollie.php"; ?>
        
    <title>WideWorldImporters</title>

</header>

<body>

<!-- Voegt de Header to aan de pagina -->

<?php include 'Includes/Header.php'; ?>

<!-- de onderstaande container zorgt dat de data gecentreerd wordt -->
<div class="container">
    <div class="row">
        <!-- Table waar de geslecteerde producten uitgelijst worden -->
        <table class="table shadow" style="margin-top: 50px">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nr.</th>
                    <th scope="col">Naam</th>
                    <th scope="col">Aantal</th>
                    <th scope="col">Opties</th>
                    <th scope="col">Prijs</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // de drie onderstaande statements behandelen de bewerking van de winkelmand
                    // onderstaande statement past de hoeveelhied van een product aan
                    if (isset($_POST['submit']) && $_POST['count'] > 0){
                        $_SESSION['cart'][$_POST['product']] = $_POST['count'];
                    }

                    // onderstaande statement verwijderd een product uit de winkelmand
                    if (isset($_POST['delete'])){
                        unset($_SESSION['cart'][$_POST['product']]);
                    }

                    if (!(isset($_SESSION['cart']))){
                        $_SESSION['cart'] = array();
                    }

                    // deze variablen zijn "sommen" deze houden het totaal vast
                    $nr = null;
                    $subTotaal = 0;


                    // de onderstaande statement lijst de producten in de winkelmand uit
                    foreach ($_SESSION['cart'] as $product => $numberOf) {

                        // data betreffend het winkelwagen item wordt opgehaald uit database
                        $query = (" SELECT *
                            FROM stockitems
                            WHERE StockItemID = $product
                        ");

                        $connection = dbConnectionRoot();
                        $result = mysqli_query($connection, $query);
                        $row = mysqli_fetch_assoc($result);

                        // hierdonder wordt het totaal per product en het subtotaal berekend
                        $totaalPerProduct = round(($row['RecommendedRetailPrice'] * $numberOf * USDToEUR()), 2);
                        $subTotaal += $totaalPerProduct;
                        $Korting =round(($subTotaal * 0.90) , 2);

                        // hier onder wordt het formaat van de nummers aangepast zodat deze juist weergeven kan worden
                        $totaalPerProductFormat = number_format($totaalPerProduct, 2, ",",".");
                        $subTotaalFormat = number_format($subTotaal, 2, ",",".");
                        $subTotaalExclBTWFormat = number_format(($Korting / 1.21), 2, ",",".");
                        $subTotaalInclBTWFormat = number_format($Korting, 2, ",",".");
                        $mollieFormat = number_format($Korting, 2, ".",""); //mollie heeft een ander nummer formaat nodig

                        // deze print functie print 1 product rij uit in de winkelmand
                        print('
                            <tr>
                                <th scope="col">'.$nr.'</th>
                                <th scope="col">'. $row['StockItemName'] .'</th>
                                <th scope="col">
                                    <form id="updateNumberOf" method="post">
                                        <input name="product" type="hidden" value="'.$product.'"/>
                                        <input name="count" class="form-control" type="number" value="'.$numberOf.'"/>
                                </th>
                                <th scope="col">
                                        <button type="submit" name="submit" class="btn btn-primary"> Bewerk </button>
                                        <button type="submit" name="delete" class="btn btn-danger"> Verwijder </button>
                                    </form>
                                </th>
                                <th scope="col">€ '. $totaalPerProductFormat .'</th>
                            <tr>
                        ');

                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- in de onderstaande row worden de totaal prijzen berekend en worden ze -->
    <div class="row">
        <div class="col-8">
        </div>
        <div class="col-4 shadow" style="padding: 10px;">
            <div class="row">
                <!-- subtotaal -->
                <div class="col-8">
                    <p>Subtotaal</p>
                </div>
                <div class="col-4">
                    <p>€<?php if (isset($subTotaalFormat)){ print $subTotaalFormat; }?></p>
                </div>
            </div>
            <div class="row">
                <!-- Met toegepaste korting -->
                <div class="col-8">
                    <p>Met 10% Korting</p>
                </div>
                <div class="col-4">
                    <p>€<?php if (isset($Korting)){ print $Korting; }?></p>
                </div>
            </div>
            <div class="row">
                <!-- verzendkosten -->
                <div class="col-8">
                    <p>Verzendkosten</p>
                </div>
                <div class="col-4">
                    <p class="text-success">Gratis</p>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row">
                <!-- totaal exclusief btw -->
                <div class="col-8">
                    <p>Totaal (excl. BTW)</p>
                </div>
                <div class="col-4">
                    <p>€ <?php if (isset($subTotaalExclBTWFormat)){ print $subTotaalExclBTWFormat; } ?> </p>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row">
                <!-- totaal inclusief btw -->
                <div class="col-8">
                    <h6>Totaal (incl. BTW)</h6>
                </div>
                <div class="col-4">
                    <h6>€<?php if (isset($subTotaalInclBTWFormat)){ print $subTotaalInclBTWFormat; } ?></h6>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col">
                    <a class="btn btn-success btn-block" href="<?php if (isset($mollieFormat)){ print (createPayment($mollieFormat)); } else {print ('#');}?>"> Afrekenen </a>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'Includes/Footer.php';?>


</body>
</html>
