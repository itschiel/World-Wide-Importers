<?php
include "Includes/Header.php";
?>

<!DOCTYPE html>
<html>
<head> 
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="container">
<div class="col mx-auto">
        <div class="container">
        <div class="row d-flex justify-content-center">
        <div class="row d-flex justify-content-center">

            <div class="card" style="width: 30rem;">
            <div class="card border-dark mb-3">
            <div class="card-body text-dark">
                          
                          <h2 class="card-title text-center">Verifieren</h2>
                          <br>
                          <div class="card-title text-center">                     
                          <?php
                            include_once 'Functions/dbconnections.php';

                            if(isset($_GET['vkey'])) {
                                $vkey = $_GET['vkey'];
                                $connection = dbConnectionRoot();
                                $sql = "SELECT verified, vkey FROM customers WHERE verified = 0 AND vkey='$vkey';";
                                $result = $connection->query($sql);

                                if(mysqli_num_rows($result) ==1)  {
                                    $sqlupdate = "UPDATE customers SET verified = 1 WHERE vkey = '$vkey' LIMIT 1;";
                                    $update = $connection->query($sqlupdate);
                                    
                                    if($update) {
                                        print("<label>Uw account is geverifieerd, u kunt nu inloggen.</label>");
                                    } elseif (!$update) {
                                        print("<label>Uw account is al geverifieerd</label");
                                    }
                                }
                            } else {
                                    print("<lable>Er is een verkeerde mannier gebruikt om bij deze pagina te komen</label>");
                        }
                          ?>
                          </div>
            </div>  
            </div>
            </div>
        </div>
        </div>
        </div>
</div>
</div>
</body>

<?php
include "Includes/Footer.php";
?>