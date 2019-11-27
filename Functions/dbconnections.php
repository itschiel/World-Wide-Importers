<?php
    function dbConnectionRoot () {

        $dbServername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "wideworldimporters";

        $connection = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

        return $connection;
    }
?>