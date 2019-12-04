<?php
include "Includes/Header.php";
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Login</h2>
            <form action="loginfunction.php" method="post">
                <div class="form-group">
                    <input name="email" type="email" class="form-control" placeholder="E-mailadres">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Wachtwoord">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <a href="www.google.nl">Wachtwoord vergeten</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </div>  
            </form>
        </div>
    </div>
</div>

<!-- Registratie knop -->
<a href="signup.php">Nog geen account? Registreer hier!</a>

<?php
include "Includes/Footer.php";
?>