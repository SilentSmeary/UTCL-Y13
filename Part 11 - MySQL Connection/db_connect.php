<?php
$servername = "localhost";
$username = "membes";
$password = "password123";
$dbname = "membes";

$conn = new mysqli(
    $servername, 
    $username, 
    $password, 
    $dbname
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully test";
?>