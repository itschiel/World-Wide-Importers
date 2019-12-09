<?php
include "Includes/Header.php";
?>

<html>
<body>
<!-- login form -->
<form action="loginfunctions.php" method="post">
    <input type="text" name="email" placeholder="E-mailadres"><br>
    <input type="password" name="password" placeholder="Wachtwoord"><br>
    <button type="submit" name="login">Login</button><br>
</form>

<!-- Registratie knop -->
<a href="signup.php">Nog geen account? Registreer hier!</a>
</body>
</html>

<?php
include "Includes/Footer.php";
?>
