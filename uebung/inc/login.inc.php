<?php

$servername = "localhost";
$username = "Admin";
$password = "admin123";
$dbname = "web_php";

// Create Connetcion
$connection = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($connection->connect_error) {
    die("Connection failed: ".$connection->connect_error)."<br/>";
}

?>