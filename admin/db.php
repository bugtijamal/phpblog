<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname ="myproject";

// Create connection
$db = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}



