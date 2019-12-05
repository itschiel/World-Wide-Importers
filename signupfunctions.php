<?php
//Here we check if the user came by pressing the button at the signup page
if(isset($_POST['signupbutton'])) {
    include "Functions/dbconnections.php";

    $fullName = $_POST['FullName'];
    $customerCategory = 3;
    $email = $_POST['EmailAddress'];
    $password = $_POST['Password'];
    $passwordRepeat = $_POST['PasswordRepeat'];
    $phoneNumber = $_POST['PhoneNumber'];
    $faxNumber = $_POST['FaxNumber'];
    $billToCustomerID = 3;
    $buyingGroupID = 1;
    $primaryContactPersonId = 1056;
    $alternateContactPersonID = 1057;
    $deliveryMethodID = 3;
    $deliveryCityID = 19881;
    $postalCityId = 19881;
    $accountOpenedDate = '2019-12-04';
    $standardDiscountPercentage = 0.000;
    $isStatementsent = 0;
    $isOnCreditHold = 0;
    $paymentDays = 7;
    $websiteURL = "ThisIsAStandardsite.com";
    $deliveryAddressLine1 = 'Standard address 101';
    $deliveryPostalCode = 90549;
    $postalAddressLine1 = 'Standaard PO box';
    $postalPostalCode = '99999';
    $lastEditedBy = 1;
    $validFrom = '2019-12-04 00:00:00';
    $validTo = '9999-12-31 23:59:59';
    $maxCustomerID = 6648;  //"SELECT MAX(CustomerID) FROM customers;";


    //First we check if there are any errors while making the account
    if(empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat) OR empty($phoneNumber) OR empty($faxNumber)){
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
            } else{
                $sql = "INSERT INTO customers (
                    CustomerID, CustomerName, CustomerCategoryID, 
                    PhoneNumber, FaxNumber, EmailAddress, 
                    HashedPassword, BillToCustomerID, BuyingGroupID, 
                    PrimaryContactPersonId, AlternateContactPersonID, DeliveryMethodID, 
                    DeliveryCityID, PostalCityId, AccountOpenedDate, 
                    StandardDiscountPercentage, IsStatementsent, IsOnCreditHold,  
                    PaymentDays, WebsiteURL, DeliveryAddressLine1, 
                    DeliveryPostalCode, PostalAddressLine1, PostalPostalCode, 
                    LastEditedBy, ValidFrom, ValidTo
                    ) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                $statement = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($statement, $sql)) {
                    //This checks if the statement got executed correctly
                    header("Location: signup.php?error=sqlerrorinsert");
                    exit();
                } else {
                    //First we has the password. This is because if a hacker were to hack into the database, it could only see the hashed passwords.
                    // We use this hashing method because it is always updated when there is a security breach.
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $maxCustomerID++;
                    //Again, we are making a prepared statement for security. This time we use 3 s'es because we want 3 different variables
                    mysqli_stmt_bind_param($statement, "sssssssssssssssssssssssssss", 
                    $maxCustomerID, $fullName, $customerCategory, $email, $hashedPassword, $phoneNumber, $faxNumber, $billToCustomerID, 
                    $buyingGroupID, $primaryContactPersonId, $alternateContactPersonID, $deliveryMethodID, $deliveryCityID, $postalCityId, $accountOpenedDate, 
                    $standardDiscountPercentage, $isStatementsent, $isOnCreditHold, $paymentDays, $websiteURL, $deliveryAddressLine1, $deliveryPostalCode, 
                    $postalAddressLine1, $postalPostalCode, $lastEditedBy, $validFrom, $validTo);
                    mysqli_stmt_execute($statement);
                    //A message that the signup was succesfull
                    header("Location: signup.php?signup=success");
                    exit();
                }
            }
        //}
    //}
    //Here we close all the connections
    mysqli_stmt_close($statement);
    mysqli_close($connection);
} else {
    //if the user came here by editing their url they get send back to the signup page
    header("Location: signup.php");
    exit();
}