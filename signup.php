<?php
include "Includes/Header.php";
?>

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

    <div class="card" style="width: 35rem;">
    <div class="card-body text-dark">

      <h2 class="card-title text-center">Aanmelden</h2>
      <div>
          <?php
          if(isset($_GET['signupbutton'])) {
            if(isset($_GET['error'])) {
              if($_GET['error'] == "emptyfields") {
                  print('<label>Vul alle velden in</label>');
              } elseif ($_GET['error'] == "invalidname") {
                  print('<label>Ongeldige naam</label>');
              } elseif ($_GET['error'] == "invalidmail") {
                  print('<label>Uw gekozen e-mail is ongeldig</label>');
              } elseif ($_GET['error'] == "passwordshort") {
                  print('<label>Uw wachtwoord is te kort</label>');
              } elseif ($_GET['error'] == "passwordnumber") {
                print('<label>Uw wachtwoord bevat geen nummer</label>');
              } elseif ($_GET['error'] == "passworddiget") {
                print('<label>Uw wachtwoord bevat geen apart teken</label>');
              } elseif ($_GET['error'] == "passwordcheck") {
                print('<label>Uw wachtwoordden komen niet overeen</label>');
              } 
            }
          }
          ?>
      </div>

      <form class="form-signin" action="signupfunctions.php" method="post">
        <div class="form-label-group">
          <label for="name">Naam</label>
          <input type="name" name="FullName" class="form-control" placeholder="Naam" required autofocus>
        </div>
        <br>
        <div class="form-label-group">
          <label for="email">E-mailadres</label>
          <input type="email" name="EmailAddress" class="form-control" placeholder="E-mailadres" required>
        </div>
        <br>
        <div class="form-label-group">
          <label for="password">Wachtwoord</label>
          <input type="password" name="Password" class="form-control" placeholder="Wachtwoord" required>
        </div>
        <br>
        <div class="form-label-group">
          <label for="password">Herhaal uw wachtwoord</label>
          <input type="password" name="PasswordRepeat" class="form-control" placeholder="Herhaal wachtwoord" required>
        </div>
        <br>
        <div class="form-label-group">
          <label for="phonenumber">Telefoonnummer</label>
          <input type="phonenumber" name="PhoneNumber" class="form-control" placeholder="Telefoonnummer" required>
        </div>
        <br>
        <div class="form-label-group">
          <label for="adres">Adres</label>
          <input type="adres" name="DeliveryAddress" class="form-control" placeholder="Adres" required>
        </div>
        <br>
        <div class="form-label-group">
          <label for="postalcode">Postcode</label>
          <input type="postalcode" name="PostalCode" class="form-control" placeholder="Postcode" required>
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="signupbutton">Registreer</button>
      </form>

    </div>  
    </div>
    </div>  

    <div class="card" style="width: 20rem;">
    <div class="card-body text-dark">
      
      <h2 class="card-title text-center">Voorwaarden</h2>
      <br>
      <h4>Naam</h4>
      <label>Uw naam mag geen aparte tekens bevatten.</label>
      <h6>Uw naam mag bestaan uit:</h6>
      <ul>
        <li>Hoofdletters</li>
        <li>Kleine letters</li>
       </ul>
      <h4>E-mailadres</h4>
      <label>U moet uw e-mailadres invoeren, omdat u een verificatiemailtje krijgt.</label>
      <br><br>
      <h4>Wachtwoord</h4>
      <h6>Uw wachtwoord moet minimaal:</h6>
      <ul>
        <li>6 tekens bevatten</li>
        <li>Een hoofdletter bevatten</li>
        <li>Een kleine letter bevatten</li>
        <li>Een cijfer bevatten</li>
        <li>Een raar teken als <br>'@', '!', '?', '%', '*' of '&' teken bevatten</li>
      </ul>
    </div>  
    </div>
    </div>
  </div>  
  </div>
  </div>

</div>  
</div>

</body>
</html>

<?php
include "Includes/Footer.php";
?>