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
                        <div class="card border-dark mb-3">
                        <div class="card-body text-dark">

                          <h2 class="card-title text-center">Aanmelden</h2>
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
                        <div class="card border-dark mb-3">
                        <div class="card-body text-dark">
                          
                          <h2 class="card-title text-center">Voorwaarden</h2>
                          <br>
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
                            <li>Een '@', '!', '?', '%', '*' of '&' teken bevatten</li>
                          </ul>
                          
                          

                        </div>  
                        </div>
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
</html>

<?php
include "Includes/Footer.php";
?>
