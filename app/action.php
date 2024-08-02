<?php
// Database configuration
$hostname = 'localhost';
$username = "root";
$password = '';
$database = 'recipes';
// Establish database pdoection
$conn = mysqli_connect($hostname, $username, $password, $database);
// Check pdoection
if (!$conn) {
    die('connection failed: ' . mysqli_connect_error());
}
?>
