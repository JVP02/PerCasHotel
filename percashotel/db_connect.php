<?php
// Database configuration
$host = "localhost";
$db_name = "admin_login";
$username = "root";
$password = "";

// Create a connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
