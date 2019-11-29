<?php
//Here we check if the user came by pressing the button at the signup page
if(isset($_POST['signupknop'])) {
    include "connection.php";

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordrepeat = $_POST['passwordrepeat'];

    //First we check if there are any errors while making the account
    if(empty($username) OR empty($email) OR empty($password) OR empty($passwordrepeat)){
        //This is to send the info back. We dont send the password back because it will pop up in the url and we dont want that
        header("Location: signup.php?error=emptyfields&username=".$username."&email=".$email);
        //If the user made a mistake we dont want to continue the code, so we exit it
        exit();
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) AND !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        //If both the email and username are invalid we dont send anything back
        header("Location: signup.php?error=invalidmailusername&username=".$username."&email=".$email);
        exit();
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //If the email is invalid we want to send the user back with the error that the email in invalid, and we want to only send the username back
        header("Location: signup.php?error=invalidmail&email=".$email);
        exit();
    } elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        //Same thing for the username. If the username is invalid the user gets its email back
        header("Location: signup.php?error=invalidusername&username=" . $username);
        exit();
    } elseif($password !== $passwordrepeat) {
        header("Location: signup.php?error=passwordcheck&username=".$username."&email=".$email);
    } else {
        //if there are no errors we get here and here is where we start creating the account and adding the account data to the database
        //The comma's are placeholders. Instead we use prepared statement so people can put sql querys in their username while signing up
        $sql = "SELECT usernameuser
                FROM users
                WHERE usernameuser=?;";
        $statement = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($statement, $sql)) {
            //This checks if the statement got executed correctly
            header("Location: signup.php?error=sqlerror");
            exit();
        } else {
            //This checks if there are any usernames the same as the one the user gave up.
            // After the comma is the datatype we want to implement, s=string
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            //This stores all the results from the execute in the $statements variable
            mysqli_stmt_store_result($statement);
            //This checks how many rows we got back, this should probably be 1 or 0
            $resultCheck = mysqli_stmt_num_rows($statement);
            if ($resultCheck > 0) {
                header("Location: signup.php?error=usertaken&mail=".$email);
                exit();
            } else{
                $sql = "INSERT INTO users (usernameuser, emailuser, passworduser) VALUE (?, ?, ?)";
                $statement = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($statement, $sql)) {
                    //This checks if the statement got executed correctly
                    header("Location: signup.php?error=sqlerror");
                    exit();
                } else {
                    //First we has the password. This is because if a hacker were to hack into the database, it could only see the hashed passwords.
                    // We use this hashing method because it is always updated when there is a security breach.
                    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
                    //Again, we are making a prepared statement for security. This time we use 3 s'es because we want 3 different variables
                    mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedpassword);
                    mysqli_stmt_execute($statement);
                    //A message that the signup was succesfull
                    header("Location: signup.php?signup=success");
                    exit();
                }
            }
        }
    }
    //Here we close all the connections
    mysqli_stmt_close($statement);
    mysqli_close($connection);
} else {
    //if the user came here by editing their url they get send back to the signup page
    header("Location: signup.php");
    exit();
}