<?php
$servername = "localhost";
$username = "root"; // Default username for MySQL in XAMPP
$password = "";     // No password by default
$database = "Project"; //database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
