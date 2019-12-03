<?php
//Here we check if the user came by pressing the button at the signup page
if(isset($_POST['signupbutton'])) {
    include "Functions/dbconnections.php";

    $fullName = $_POST['FullName'];
    $prefferedName = $_POST['PrefferedName'];
    $email = $_POST['EmailAddress'];
    $password = $_POST['Password'];
    $passwordRepeat = $_POST['PasswordRepeat'];
    $phoneNumber = $_POST['PhoneNumber'];
    $faxNumber = $_POST['FaxNumber'];

    //First we check if there are any errors while making the account
    if(empty($fullName) OR empty($prefferedName) OR empty($email) OR empty($password) OR empty($passwordRepeat) OR empty($phoneNumber) OR empty($faxNumber)){
        //This gives the error to show that there are empty fields
        header("Location: signup.php?error=emptyfields");
        //If the user made a mistake we dont want to continue the code, so we exit it
        exit();
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) AND !preg_match("/^[a-zA-Z0-9]*$/", $fullName)) {
        //If both the email and username are invalid we send back this error
        header("Location: signup.php?error=invalidmailusername");
        exit();
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //If the email is invalid we want to send the user back with the error that the email in invalid
        header("Location: signup.php?error=invalidmail");
        exit();
    } elseif(!preg_match("/^[a-zA-Z0-9]*$/", $fullName)) {
        //Yet another error message for when the full name is taken
        header("Location: signup.php?error=invalidusername");
        exit();
    } elseif($password !== $passwordRepeat) {
        header("Location: signup.php?error=passwordcheck");
    } else {
        //If there are no errors we get here and here is where we start creating the account and adding the account data to the database
        //The comma's are placeholders. Instead we use prepared statement so people can put sql querys in their username while signing up
        $sql = "SELECT FullName
                FROM people
                WHERE FullName=?;";
        $statement = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($statement, $sql)) {
            //This checks if the statement got executed correctly
            header("Location: signup.php?error=sqlerrorsearch");
            exit();
        } else {
            //This checks if there are any usernames the same as the one the user gave up.
            // After the comma is the datatype we want to implement, s=string
            mysqli_stmt_bind_param($statement, "s", $fullName);
            mysqli_stmt_execute($statement);
            //This stores all the results from the execute in the $statements variable
            mysqli_stmt_store_result($statement);
            //This checks how many rows we got back, this should probably be 1 or 0
            $resultCheck = mysqli_stmt_num_rows($statement);
            if ($resultCheck > 0) {
                header("Location: signup.php?error=usertaken");
                exit();
            } else{
                $sql = "INSERT INTO people (Fullname, PrefferedName, EmailAddress, HashedPassword, PhoneNumber, FaxNumber) VALUE (?, ?, ?, ?, ?, ?)";
                $statement = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($statement, $sql)) {
                    //This checks if the statement got executed correctly
                    header("Location: signup.php?error=sqlerrorinsert");
                    exit();
                } else {
                    //First we has the password. This is because if a hacker were to hack into the database, it could only see the hashed passwords.
                    // We use this hashing method because it is always updated when there is a security breach.
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    //Again, we are making a prepared statement for security. This time we use 3 s'es because we want 3 different variables
                    mysqli_stmt_bind_param($statement, "ssssss", $fullName, $prefferedName, $email, $hashedPassword, $phoneNumber, $faxNumber);
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