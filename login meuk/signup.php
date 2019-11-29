<?php
include "header.php";
?>

<html>
<body>
<h3>Aanmelden</h3>
<?php
if(isset($_GET['error'])) {
    if($_GET['error'] == "emptyfields") {
        print('<p>Vul alle velden in</p>');
    } elseif ($_GET['error'] == "invalidname") {
        print('<p>Uw naam is al gekozen</p>');
    } elseif ($_GET['error'] == "invalidmail") {
        print('<p>Uw gekozen e-mail is ongeldig</p>');
    } elseif ($_GET['error'] == "passwordcheck") {
        print('<p>Wachtwoorden komen niet overeen</p>');
    }
} elseif($_GET['signup'] == "success") {
    print('<p>Aanmelding is gelukt</p>');
}
?>
<form action="signupfunctions.php" method="post">
    Gebruikersnaam: <input type="text" name="username"><br>
    E-mail:<input type="text" name="email"><br>
    Wachtwoord: <input type="password" name="password"><br>
    Herhaal uw wachtwoord: <input type="password" name="passwordrepeat"><br>
    <button type="submit" name="signupknop">Registreer</button>
</form>
</body>
</html>

<?php
include "footer.php";
?>
