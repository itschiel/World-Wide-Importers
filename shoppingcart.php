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


<?php 

    //$_SESSION['cart'] = array();
    
?>
<div class="container">
    <div class="row">
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
                    if(!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = array();
                    }

                    if (isset($_POST['submit']) && $_POST['count'] > 0){
                        $_SESSION['cart'][$_POST['product']] = $_POST['count'];
                    }

                    if (isset($_POST['delete'])){
                        unset($_SESSION['cart'][$_POST['product']]);
                    }

                    $nr = null;
                    $subTotaal = 0;

                    foreach ($_SESSION['cart'] as $product => $numberOf) {
                        
                        $query = (" SELECT *
                            FROM stockitems
                            WHERE StockItemID = $product
                        ");

                        $result = mysqli_query(dbConnectionRoot(), $query);
                        $row = mysqli_fetch_assoc($result);
                        
                        $nr++;
                        $price = (($row['RecommendedRetailPrice'] * USDToEUR()) * $numberOf);
                        $priceFormat = number_format($price, 2, ",",".");
                        $subTotaal += $price;

                        $mollie = number_format($subTotaal, 2, ".","");
                        $subTotaal = number_format($subTotaal, 2, ",",".");


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
                                <th scope="col">€ '. $priceFormat .'</th>
                            <tr>
                        ');

                    }
                ?>
            </tbody>
        </table>
    </div>
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
                    <p>€<?php ?></p>
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
                    <a class="btn btn-success btn-block" href="<?php print createPayment($mollie);?>"> Afrekenen </a>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'Includes/Footer.php';?>


</body>
</html>
