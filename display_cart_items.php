<?php
// Start session
session_start();

$servername = "localhost";
$username = "root"; // Default username for MySQL in XAMPP
$password = "";     
$database = "Project"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user_id from session (assuming user is logged in)
$user_id = 4; 

// Fetch cart items for the user from the database
$sql = "SELECT product_name, product_price FROM cart WHERE user_id = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Generate HTML to display cart items
$html = '';
while ($row = $result->fetch_assoc()) {
    $html .= '<div>';
    $html .= '<p>' . htmlspecialchars($row['product_name']) . '</p>';
    $html .= '<p>$' . htmlspecialchars($row['product_price']) . '</p>';
    $html .= '</div>';
}

// Output HTML
echo $html;

// Close the statement and connection
$stmt->close();
$conn->close();
?>

