<?php
$servername = "localhost"; // or your database server
$username = "root"; // your MySQL username
$password = ""; // your MySQL password
$dbname = "caloriecalc"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
