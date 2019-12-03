<?php
include "Includes/Header.php";
?>

<!-- login form -->
<form action="loginfunctions.php" method="post">
    <input type="text" name="emailusername" placeholder="E-mailadress of gebruikersnaam"><br>
    <input type="password" name="password" placeholder="Wachtwoord"><br>
    <button type="submit" name="login">Login</button><br>
</form>

<!-- Registratie knop -->
<a href="signup.php">Nog geen account? Registreer hier!</a>

<?php
include "Includes/Footer.php";
?>