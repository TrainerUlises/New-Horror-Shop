<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" type="text/css" href="checkout.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-image: url('images/Horror.jpg');
    background-color: #f8f8f8;
    margin: 0;
    padding: 0;
}

        .thank-you {
            text-align: center;
            padding: 20px;
            font-size: 24px;
            
            color: #333;
            background-color: #f0f0f0;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
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
        // Your database connection details
        $servername = "localhost";
        $username = "root"; // Default username for MySQL in XAMPP
        $password = "";     // No password by default
        $database = "Project"; // Database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Assuming you have a user ID available
        $user_id = 4;

        // Initialize total price variable
        $total_price = 0;

        // Fetch cart items for the user from the database
        $sql = "SELECT * FROM cart WHERE user_id = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "Product: " . $row["product_name"]. " - Price: $" . $row["product_price"]. "<br>";
                // Add the price of each item to the total
                $total_price += $row["product_price"];
                // Here you could process the checkout logic, such as updating inventory, processing payment, etc.
            }
            // After processing, you might want to clear the user's cart
            $sql = "DELETE FROM cart WHERE user_id = $user_id";
            if ($conn->query($sql) === TRUE) {
                // Display total price and thank you message
                echo '<div class="thank-you">SUCCESSFUL CHECKOUT! THANK YOU FOR YOUR PURCHASE<br>Total Price: $' . $total_price . '</div>';
            } else {
                echo "Error clearing cart: " . $conn->error;
            }
        } else {
            echo "No items in the cart.";
        }

        // Close the connection
        $conn->close();
        ?>
    </section>
</body>
</html>


