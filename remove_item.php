<?php
// Start session
session_start();

// Check if user_id exists in session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if user is not logged in
    exit();
}

// Check if cart_id is provided via POST method
if(isset($_POST['cart_id'])) {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "Project";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL statement to delete the item from the cart
    $cart_id = $_POST['cart_id'];
    $user_id = $_SESSION['user_id'];
    $sql = "DELETE FROM cart WHERE cart_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cart_id, $user_id);

    if ($stmt->execute()) {
        // Redirect back to cart.php after successful removal
        header("Location: cart.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to cart.php if cart_id is not provided
    header("Location: cart.php");
    exit();
}
?>
