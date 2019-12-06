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


<?php 

    //$_SESSION['cart'] = array();
    
?>
<div class="container">
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
                if (isset($_POST['submit']) && $_POST['count'] > 0){
                    $_SESSION['cart'][$_POST['product']] = $_POST['count'];
                }

                if (isset($_POST['delete'])){
                    unset($_SESSION['cart'][$_POST['product']]);
                }

                $nr = null;

                foreach ($_SESSION['cart'] as $product => $numberOf) {
                    
                    $query = (" SELECT *
                        FROM stockitems
                        WHERE StockItemID = $product
                    ");

                    $result = mysqli_query(dbConnectionRoot(), $query);

                    $row = mysqli_fetch_assoc($result);

                    $nr++;

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
                            <th scope="col">€ '. round((($row['RecommendedRetailPrice'] * USDToEUR()) * $numberOf),2) .'</th>
                        <tr>
                    ');


                }



            ?>

        </tbody>
    </table>
</div>



<?php include 'Includes/Footer.php';?>


</body>
</html>
