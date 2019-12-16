<?php
include "Includes/Header.php";
?>
<!-- 
<!DOCTYPE html>
<html>
<head> 
        Bootstrap CSS
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- </head>
<body>
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto"> --> -->
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
        }
    } else {
        print("<lable>Dit account bestaat niet of is al geverifieerd.</label>");
    }

} else {
    header('Location: index.php?error=incorrectorder');
}
?>
      <!-- </div>
    </div>
</div>
</body> -->

<?php
include "Includes/Footer.php";
?>
