<?php
//Here we check if the user came by pressing the button at the signup page
if(isset($_POST['signupbutton'])) {
    include_once "Functions/dbconnections.php";    
    $connection = dbConnectionRoot();
    //All variables are needed because the database isn't auto incremented
    $fullName = $_POST['FullName'];
    $customerCategory = 3;
    $email = $_POST['EmailAddress'];
    $password = $_POST['Password'];
    $passwordRepeat = $_POST['PasswordRepeat'];
    $phoneNumber = $_POST['PhoneNumber'];
    $faxNumber = 3;
    $billToCustomerID = 3;
    $buyingGroupID = 1;
    $primaryContactPersonId = 1056;
    $alternateContactPersonID = 1057;
    $deliveryMethodID = 3;
    $deliveryCityID = 19881;
    $postalCityId = 19881;
    $accountOpenedDate = "2019-12-04";
    $standardDiscountPercentage = 0.000;
    $isStatementsent = 0;
    $isOnCreditHold = 0;
    $paymentDays = 7;
    $websiteURL = "ThisIsAStandardsite.com";
    $deliveryAddressLine1 = $_POST['DeliveryAddress'];
    $deliveryPostalCode = $_POST['PostalCode'];
    $postalAddressLine1 = "Standaard PO box";
    $postalPostalCode = 99999;
    $lastEditedBy = 1;
    $validFrom = "2019-12-04 00:00:00";
    $validTo = "9999-12-31 23:59:59";
    $verified = 0;
    
    //First we check if there are any errors while making the account
    if(empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat) OR empty($phoneNumber) OR empty($deliveryAddressLine1) OR empty($deliveryPostalCode)){
        //This gives the error to show that there are empty fields
        header("Location: signup.php?error=emptyfields");
        //If the user made a mistake we dont want to continue the code, so we exit it
        exit();

        //email check
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?error=invalidmail");
        exit();

        //name check
    } elseif(!preg_match("/^[a-zA-Z_ ]*$/", $fullName)) {
        header("Location: signup.php?error=invalidname");
        exit();
    
        //password checks
    } elseif (strlen($password) < 6) {
        header("Location: signup.php?error=passswordshort");
        exit();
    } elseif (!preg_match("#[0-9]+#", $password)) {
        header("Location: signup.php?error=passswordnumber");
        exit();
    } elseif(!preg_match("#[a-zA-Z]+#", $password)) {
        header("Location: signup.php?error=passswordletter");
        exit();
    } elseif (!preg_match("#[@!?%*&]+#", $password)) {
        header("Location: signup.php?error=passsworddiget");
        exit();
        //password repeat check
    } elseif($password !== $passwordRepeat) {
        header("Location: signup.php?error=passwordcheck");

        //phone check
    } elseif(!preg_match("#[0-9]+#", $phoneNumber)) {
        header("Location: signup.php?error=phone");
        //address check
    } elseif(!preg_match("/^[a-zA-Z0-9_ ]*$/", $deliveryAddressLine1)) {
        header("Location: signup.php?error=address");
    } elseif(!preg_match("/^[a-zA-Z0-9_ ]*$/", $deliveryPostalCode)) {
        header("Location: signup.php?error=postcode");
            } else {
                $sql ="SELECT CustomerID
                FROM Customers
                ORDER BY CustomerID DESC
                LIMIT 1";
                $result = (mysqli_query($connection, $sql));
                $row =  mysqli_fetch_object($result);
                $CustomerID = ($row->CustomerID)+1;
                
                $sql = "INSERT INTO customers (
                    CustomerID, CustomerName, CustomerCategoryID, 
                    PhoneNumber, FaxNumber, EmailAddress, 
                    HashedPassword, BillToCustomerID, BuyingGroupID, 
                    PrimaryContactPersonId, AlternateContactPersonID, DeliveryMethodID, 
                    DeliveryCityID, PostalCityId, AccountOpenedDate, 
                    StandardDiscountPercentage, IsStatementSent, IsOnCreditHold, 
                    PaymentDays, WebsiteURL, DeliveryAddressLine1, 
                    DeliveryPostalCode, PostalAddressLine1, PostalPostalCode, 
                    LastEditedBy, ValidFrom, ValidTo, verified, vkey) 
                    VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                
                //Here we hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                //For email
                $length = 50;
                $vkey = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);;
                $statement = mysqli_prepare($connection, $sql);
                mysqli_stmt_bind_param($statement, "isiisssiiiiiiisiiiissssisssis", 
                $CustomerID, $fullName, $customerCategory, $phoneNumber, $faxNumber, $email, $hashedPassword, $billToCustomerID, 
                $buyingGroupID, $primaryContactPersonId, $alternateContactPersonID, $deliveryMethodID, $deliveryCityID, $postalCityId, $accountOpenedDate, 
                $standardDiscountPercentage, $isStatementsent, $isOnCreditHold, $paymentDays, $websiteURL, $deliveryAddressLine1, $deliveryPostalCode, 
                $postalAddressLine1, $postalPostalCode, $lastEditedBy, $validFrom, $validTo, $verified, $vkey);
                mysqli_stmt_execute($statement);
                if(mysqli_stmt_affected_rows($statement) == 1) {
                                     
                    $receiver = $email;
                    $subject = "Account verificatie";
                    $message = 
                    "Goedendag $fullName, <br>
                    Bedankt voor het aanmelden bij de Wide World Importers webshop.<br>
                    Om uw account te verificieren, klik op deze link: <a href='http://localhost/World-Wide-Importers/verify.php?vkey=$vkey'>Verifieer account </a>.<br>
                    Na de verificatie kunt u met uw account inloggen op de website.<br><br>
                    Met vriendelijke groet,<br>
                    Het WWI";
                    $headers = "From: wideworldimporterscompany@gmail.com" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= "MIME-Version: 1.0" . "\r\n"; 
                    mail($receiver,$subject,$message,$headers);

                    header('Location: thankyou.php');
                    
                } else {
                    print("something went wrong");
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