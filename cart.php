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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" type="text/css" href="cart.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <header>
        <h1>Shopping Cart</h1>
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
    <h2>Your Shopping Cart</h2>

    <?php
    // Start session
    session_start();

    // Execute SQL statement to fetch cart items for user_id = 4
    $sql = "SELECT * FROM cart WHERE user_id = 4";
    $result = $conn->query($sql);

    // Check if there are any cart items
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Cart ID</th><th>Product Name</th><th>Product Price</th></tr>";
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["cart_id"] . "</td>";
            echo "<td>" . $row["product_name"] . "</td>";
            echo "<td>$" . $row["product_price"] . "</td>";
            echo "<td><form action='remove_item.php' method='post'><input type='hidden' name='cart_id' value='" . $row["cart_id"] . "'><button type='submit'>Remove</button></form></td>";
            echo "</tr>";
        }        
        echo "</table>";
    } else {
        echo "<p>No items in the cart.</p>";
    }

    // Close the connection
    $conn->close();
    ?>

    <form action="checkout.php" method="post">
        <button type="submit">Proceed to Checkout</button>
    </form>
</body>
</html>




