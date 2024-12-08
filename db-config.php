<?php
$host = "localhost"; // Use "127.0.0.1" if localhost doesn't work
$username = "root";  // Replace with your MySQL username
$password = "osama";      // Replace with your MySQL password
$database = "clients";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
