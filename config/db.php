<?php
$host = "localhost";
$username = "gopinath";
$password = "Gopi!123";
$dbname = "user_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
