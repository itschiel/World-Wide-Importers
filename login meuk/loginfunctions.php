<?php
if(isset($_POST['loginknop'])) {
    include "connection.php";

    $emailUsername = $_POST['emailusername'];
    $password = $_POST['password'];

    if(empty($emailUsername) OR empty($password)) {
        header("Location: login.php?error=emptyfields");
        exit();
    } else {
        //The ? are placeholders. If he dont use ?, the loginsystem is not secure and hackers can imput sql querys that can ruin the database
        //We make prepared statements we are gonna use in the ? places
        $sql = "SELECT * 
                FROM users 
                WHERE usernameuser=? 
                OR emailuser=?;";
        $satement = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($satement, $sql)) {
            //First we test if the connection is actually here
            header("Location: login.php?error=sqlerror");
            exit();
        } else {
            //We use the same variable because the query searches for two different things. It searches for the email and the username
            mysqli_stmt_bind_param($satement, "ss", $emailUsername, $emailUsername);
            mysqli_stmt_execute($satement);
            $result = mysqli_stmt_get_result($satement);

            if($row = mysqli_fetch_assoc($result)) {
                //Here we check if the password given by the user is the same as the one in the database. This will give a bolean
                $passwordCheck = password_verify($password, $row['passworduser']);
                if($passwordCheck == FALSE) {
                    header("Location: login.php?error=wrongpassword");
                    exit();
                } elseif($passwordCheck == TRUE) {
                    session_start();
                    $_SESSION['userID'] = $row['idUsers'];
                    $_SESSION['userName'] = $row['usernameuser'];

                    header("Location: index.php?login=succes");
                    exit();
                } else {
                    header("Location: login.php?error=wrongpassword");
                    exit();
                }
            } else {
                header("Location: login.php?error=nouser");
                exit();
            }
        }
    }
} else {
    header("Location: login.php");
    exit();
}