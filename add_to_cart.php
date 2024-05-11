<?php
// Start session
session_start();

$servername = "localhost";
$username = "root"; //
$password = "";     
$database = "Project"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve product details from form submission
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];

// Sanitize user inputs (optional but recommended)
$product_name = htmlspecialchars($product_name);
$product_price = floatval($product_price); // Assuming price is a float

// Set user_id 
$user_id = "4";

// Execute SQL statement to insert item into cart
$stmt = $conn->prepare("INSERT INTO cart (user_id, product_name, product_price) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $product_name, $product_price);

if ($stmt->execute()) {
    // Item added to cart successfully
    // Redirect to cart page
    header("Location: Products.html");
    exit(); // Make sure no other output is sent
} else {
    // Error occurred while adding item to cart
    echo "Error adding item to cart: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>


