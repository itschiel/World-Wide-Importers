<?php
include "header.php";
?>

<html>
<body>
<!--Use the post message so that people cant see your stuff in the url. You get to see it if you use GET-->
<form action="loginfunctions.php" method="post">
    <input type="text" name="emailusername" placeholder="E-mailadress of gebruikersnaam">
    <!--type password so you can only see dots when you fill it in.-->
    <input type="password" name="password" placeholder="Wachtwoord">
    <button type="submit" name="loginknop">Login</button>
</form>
<a href="signup.php">Nog geen account? Registreer hier!</a>

</body>
</html>

<?php
include "footer.php";
?>
