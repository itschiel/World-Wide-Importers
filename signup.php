<?php
include "Includes/Header.php";
?>

<html>
<body>
<h3>Aanmelden</h3>
<?php
if(isset($_GET['error'])) {
    if($_GET['error'] == "emptyfields") {
        print('<p>Vul alle velden in</p>');
    } elseif($_GET['error'] == "invalidmailusername") {
        print("<p>Email en Naam ongeldig");
    } elseif ($_GET['error'] == "invalidname") {
        print('<p>Uw naam is al gekozen</p>');
    } elseif ($_GET['error'] == "invalidmail") {
        print('<p>Uw gekozen e-mail is ongeldig</p>');
    } elseif ($_GET['error'] == "passwordcheck") {
        print('<p>Wachtwoorden komen niet overeen</p>');
    }
} elseif (isset($_GET['signup']) and $_GET['signup'] == "success") {
    print('<p>Aanmelding is gelukt</p>');
}
?>
<form action="signupfunctions.php" method="post">
    Volledige naam: <input type="text" name="FullName"><br>
    Voorgekeurde naam: <input type="text" name="PrefferedName"><br>
    E-mail adres:<input type="text" name="EmailAddress"><br>
    Wachtwoord: <input type="password" name="Password"><br>
    Herhaal uw wachtwoord: <input type="password" name="PasswordRepeat"><br>
    Telefoon nummer: <input type="text" name="PhoneNumber"><br>
    Fax nummer: <input type="text" name="FaxNumber"><br>
    <button type="submit" name="signupbutton" >Registreer</button>
</form>
</body>
</html>

<?php
include "Includes/Footer.php";
?>
