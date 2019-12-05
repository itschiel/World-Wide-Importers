<html>

<head>
    <title>WideWorldImporters</title>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Functie Includes -->
        <?php include_once 'Functions/DBConnections.php'; ?>
</head>

<body>

<!-- Voegt de Header to aan de pagina -->
<?php include 'Includes/Header.php';?>

<!-- onderstaande query wordt gebruikt om de benodigde data op te halen om de besteller te bekijken -->
<!-- met de while worden de gegevens uit de query weergegeven op de website -->
<!-- de div is het kaart van bootstrap -->

<div class="card w-25">
  <div class="card-body">
    <h5 class="card-title">Persoon</h5>

    <?php
    $query = ("SELECT FullName, EmailAddress, PhoneNumber 
    FROM people WHERE PersonID = 1001;");

  $result= mysqli_query(dbConnectionRoot(), $query);

while($rows=mysqli_fetch_array($result)){
  print ("
  <tr>
  <td>". $rows['FullName']. "</td> <br>
  </tr>
  <tr>
  <td>". $rows['EmailAddress']. "</td> <br>
  </tr>
  <tr>
  <td>". $rows['PhoneNumber']. "</td> <br>
  </tr>
  ");
}
?>
  </div>
</div>

<!-- onderstaande query wordt gebruikt om de benodigde data op te halen om het bezorgadres te bevestigen -->
<div class="card w-25">
  <div class="card-body">
    <h5 class="card-title">Bezorgadres</h5>

    <?php
    $query = ("SELECT DISTINCT PersonID, CustomerName, DeliveryAddressLine1, 
    DeliveryAddressLine2, DeliveryPostalCode, CityName FROM customers cm JOIN people p 
    ON p.PersonID = cm.PrimaryContactPersonID JOIN cities ct ON ct.CityID = cm.DeliveryCityID
    WHERE PersonID = 1001;
    ");

  $result= mysqli_query(dbConnectionRoot(), $query);

while($rows=mysqli_fetch_array($result)){
  print ("
  <td>". $rows['CustomerName']. "</td><br>
  </tr>
  <tr>
  <td>". $rows['DeliveryAddressLine1']. "</td><br>
  </tr>
  <tr>
  <td>". $rows['DeliveryAddressLine2']. "</td><br>
  </tr>
  <tr>
  <td>". $rows['DeliveryPostalCode']. "</td>
  </tr>
  <tr>
  <td>". $rows['CityName']. "</td><br>
  </tr>
  ");
}
?>
  <br> <a href="#" class="btn btn-primary">Ander bezorgadres</a>
  </div>
</div>

<!-- Op deze kaart word het betaalmethode ideal getoond -->
<a href="#" class="btn btn-primary">Ga terug naar Winkelwagen</a>
<a href="#" class="btn btn-primary">Afrekenen</a>
  </div>
</div>

<!-- Voegt de Footer to aan de pagina -->
<?php include 'Includes/Footer.php';?>
</body>
</html>