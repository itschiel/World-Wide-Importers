<?php
include "header.php";
?>

<html>
<body>
<?php
if(isset($_SESSION['userID'])) {
    print('<p class="login-status">U bent ingelogd</p>');
} else {
    print('<p class="login-status">U bent uitgelogd</p>');
}
?>
</body>
</html>

