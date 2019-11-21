<?php
    function dbConnectionRoot ($Query) {

        $dbServername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "wideworldimporters";

        $connection = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

        if (isset($Query)) {
            $result = mysqli_query($connection, $Query);
            return $result;
        } else {
            return $connection;
        }

    }
?>