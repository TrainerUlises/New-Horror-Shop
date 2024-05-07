<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" type="text/css" href="checkout.css">
</head>
<body>
    <header>
        
        <nav>
            <ul>
                <li><a href="Main Menu.html">Main Menu</a></li>
                <li><a href="Products.html">Products</a></li>
                <li><a href="About_Us.html">About Us</a></li>
                <li><a href="Contact_Us.html">Contact Us</a></li>
                <li><a href="signout.html">Sign Out</a></li>
            </ul>
        </nav>
    </header>

    <section class="checkout-section">
        <?php
        // Start session
        session_start();

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

        // Check if user_id exists in session
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php"); // Redirect to login page
            exit();
        }

        // Execute SQL statement to delete all items from the cart table where user_id = 4
        $sql = "DELETE FROM cart WHERE user_id = 4";

        if ($conn->query($sql) === TRUE) {
            echo "<h2>THANK YOU FOR YOUR PURCHASE</h2>";
        } else {
            echo "Error: " . $conn->error;
        }

        // Close the connection
        $conn->close();
        ?>
    </section>
</body>
</html>

