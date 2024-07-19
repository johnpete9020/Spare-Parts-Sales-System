<?php
session_start();

// Check if the cart is set in the session
if(isset($_SESSION['cart'])) {
    // Establish connection to your local database
    $conn = new mysqli('localhost', 'root', '', 'test');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO orders (item_name, item_price, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $item_name, $item_price, $quantity);

    // Insert each item from the session cart into the database
    foreach($_SESSION['cart'] as $key => $value) {
        $item_name = $value['Item_Name'];
        $item_price = $value['Price'];
        $quantity = $value['Quantity'];
        $stmt->execute();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Clear the session cart after storing in the database
    unset($_SESSION['cart']);

    // Redirect back to the cart page or any other page you prefer
    header("Location: mycart.php");
    exit();
} else {
    // If the cart is empty, redirect back to the cart page or any other page you prefer
    header("Location: mycart.php");
    exit();
}
?>