<?php
    function USDToEUR() {
        $data = file_get_contents("https://api.exchangeratesapi.io/latest?base=USD&symbols=EUR");
        $json = json_decode($data, true);
        $EUR = $json['rates']['EUR'];
    
        return $EUR;
    }
?>