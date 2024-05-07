<?php
$servername = "localhost";
$username = "root"; // Default username for MySQL in XAMPP
$password = "";     
$database = "Project"; //database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if username and password are set in the POST request
if(isset($_POST['username'], $_POST['password'])) {
    // Prepare statement to insert user data
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

    // Bind parameters and execute the statement
    $stmt->bind_param("ss", $username, $password);

    // Set parameters
    $username = $_POST['username'];
    $password = $_POST['password']; // Use the plain-text password

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error: Username and password are required.";
}

// Close the connection
$conn->close();
?>



