<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="Login Systeem">
    <meta name=viewport content="width=device-width, initial-scale=1">
</head>
<body>
<header>
    <nav>
        <a href="index.php">
            <img src="download.png" alt="logo">
        </a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
    <div>
        <?php
        if(isset($_SESSION['userID'])) {
            print('<form action="logout.php" method="post"><button type="submit" name="logoutknop">Loguit</button></form>');
        }
        ?>
    </div>
</header>
</body>
</html>
