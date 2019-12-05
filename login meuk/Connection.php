<?php
$serverName = "localhost";
$user = "root";
$password = "";
$databaseName = "logintest";
$connection = mysqli_connect($serverName, $user, $password, $databaseName);
if(!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}