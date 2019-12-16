<?php
if(isset($_POST['loginbutton'])) {
    include_once "Functions/dbconnections.php";
    $connection = dbConnectionRoot();

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) OR empty($password)) {
        header("Location: login.php?error=emptyfields");
        exit();
    } else {
        //The ? are placeholders. If he dont use ?, the loginsystem is not secure and hackers can imput sql querys that can ruin the database
        //We make prepared statements we are gonna use in the ? places
        $sql = "SELECT * 
                FROM Customers 
                WHERE EmailAddress=?;";
        $satement = mysqli_prepare($connection, $sql);
            //We use the same variable because the query searches for two different things. It searches for the email
            mysqli_stmt_bind_param($satement, "s", $email);
            mysqli_stmt_execute($satement);
            $result = mysqli_stmt_get_result($satement);

            if($row = mysqli_fetch_assoc($result)) {
                //Here we check if the password given by the user is the same as the one in the database. This will give a bolean
                $passwordCheck = password_verify($password, $row['HashedPassword']);
                if($passwordCheck == FALSE) {
                    header("Location: login.php?error=wrongpassword");
                    exit();
                } elseif($passwordCheck == TRUE) {
                //This checks if the account is verified
                    // $sqlVerified = "SELECT verified
                    //                 FROM Customers
                    //                 WHERE EmailAddress=?
                    //                 LIMIT 1;";
                    
                    $sqlVerified = "SELECT verified
                                    FROM Customers
                                    WHERE EmailAddress='$email'
                                    LIMIT 1;";
                    $resultVerified = (mysqli_query($connection, $sqlVerified));
                    $rowVerified =  mysqli_fetch_assoc($resultVerified);
                    $verifiedCheck = ($rowVerified['verified']);
                    
                    // $statementVerified = mysqli_prepare($connection, $sqlVerified);
                    // mysqli_stmt_bind_param($statementVerified, "s", $email);
                    // mysqli_stmt_execute($statementVerified);
                    // $verifiedCheck = mysqli_stmt_get_result($statementVerified);
                    
                    // if($verifiedCheck == 0) {
                    //     print("0");
                    // } elseif($verifiedCheck == 1) {
                    //     print("1");
                    // }
                    if ($verifiedCheck == FALSE) {
                        header("Location: login.php?error=verified");
                    } elseif ($verifiedCheck == TRUE) {
                        session_start();
                        $_SESSION['CustomerID'] = $row['CustomerID'];
                        header("Location: index.php?login=succes");
                        exit();
                    }
                 } elseif ($passwordCheck == FALSE) {
                        header("Location: login.php?error=wrongpassword");
                        exit();
                } 
            } else {
                header("Location: login.php?error=nouser");
                exit();
        } 
    }
} else {
    header("Location: login.php");
    exit();
}