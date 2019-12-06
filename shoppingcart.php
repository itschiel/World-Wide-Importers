<?php session_start() ?>

<html>

<header>

    <?php include_once 'Functions/DBconnections.php'; ?>
    <?php include_once 'Functions/api.php'; ?>
        
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
                    // onderstaande statement past de hoeveelhied van een product aan
                    if (isset($_POST['submit']) && $_POST['count'] > 0){
                        $_SESSION['cart'][$_POST['product']] = $_POST['count'];
                    }

                    // onderstaande statement verwijderd een product uit de winkelmand
                    if (isset($_POST['delete'])){
                        unset($_SESSION['cart'][$_POST['product']]);
                    }

                    $nr = null;
                    $subTotaal = null;

                    // de onderstaande statement lijst de producten uit
                    foreach ($_SESSION['cart'] as $product => $numberOf) {
                        
                        $query = (" SELECT *
                            FROM stockitems
                            WHERE StockItemID = $product
                        ");

                        $result = mysqli_query(dbConnectionRoot(), $query);
                        $row = mysqli_fetch_assoc($result);
                        
                        $nr++;
                        $price = (round((($row['RecommendedRetailPrice'] * USDToEUR()) * $numberOf),2)); //hier wordt de prijs berekend op basis van het aantal per product en de koers van de euro
                        $subTotaal += $price;
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
                                <th scope="col">€ '. $price .'</th>
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
                <div class="col-8">
                    <p>Subtotaal</p>
                </div>
                <div class="col-4">
                    <p>€<?php print $subTotaal; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <p>Verzendkosten</p>
                </div>
                <div class="col-4">
                    <p class="text-success">Gratis</p>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row">
                <div class="col-8">
                    <p>Totaal (excl. BTW)</p>
                </div>
                <div class="col-4">
                    <p>€<?php print round(($subTotaal * 0.79),2); ?></p>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row">
                <div class="col-8">
                    <h6>Totaal (incl. BTW)</h6>
                </div>
                <div class="col-4">
                    <h6>€<?php print $subTotaal; ?></h6>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col">
                    <a href="#" class="btn btn-success btn-block"> Afrekenen </a>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'Includes/Footer.php';?>


</body>
</html>
