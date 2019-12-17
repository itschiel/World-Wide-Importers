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

                    <h2 class="card-title text-center">Contact</h2>


                    <form class="form-signin" method="post">
                        <div class="form-label-group">
                            <label for="email">E-mailadres</label>
                            <input type="text" name="email" class="form-control" placeholder="E-mailadres" required autofocus>
                            <br>
                        </div>
                        <div class="form-label-group">
                            <label for="onderwerp">Onderwerp</label>
                            <input type="text" name="subject" class="form-control" placeholder="Onderwerp" required autofocus>
                            <br>
                        </div>
                        <div class="form-label-group">
                            <label for="text">Bericht</label>
                            <textarea type="text" name="message" rows="7" class="form-control md-textarea" placeholder="Typ hier uw bericht" required autofocus></textarea>
                            <br>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="sendbutton">Verstuur</button>
                    </form>

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
if(isset($_POST['sendbutton'])){
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $customerid = $_SESSION['CustomerID'];

    $mailto = "wideworldimporterscompany@gmail.com";
    $headers = "From: " . $email;
    $text = "You have recieved an e-mail from:\n 
    CustomerID: " . $customerid . "\n
    Email: " . $email . "\n\n" . $message;

    mail($mailto,$subject,$text,$headers);
}
?>