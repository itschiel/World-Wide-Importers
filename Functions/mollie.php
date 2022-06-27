<?php
    function mollieInit(){
      
        \ini_set('display_errors', 1);
        \ini_set('display_startup_errors', 1);
        \error_reporting(\E_ALL);
        require_once __DIR__ . "/../mollie/vendor/autoload.php";
    
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey("test_QP4S6PV75uhQUfAt7m8QMDCKgCaMyD");
    
        return $mollie;

    }

    function createPayment($price) {

        $payment = mollieInit()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => "$price"
            ],
            "description" => "Order #12345",
            "redirectUrl" => "http://localhost/World-Wide-Importers/index.php",

        ]);
        return $payment->getCheckoutUrl();

    }

?>
