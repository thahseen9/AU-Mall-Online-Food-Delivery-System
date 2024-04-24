<?php
include 'connect.php';

// Retrieve C_ID from the session
    session_start();
    if (isset($_SESSION['C_ID'])) {
        $C_ID = $_SESSION['C_ID'];
        $address = $_SESSION['address'];
    } else {
        // Redirect to the login page if C_ID is not set in the session
        header("Location: Login_customer.php");
        exit();
    }

// Retrieve other data from the POST request
$restaurant_id = $_POST['restaurant_id'];
$ordered_items = $_POST['ordered_items'];

// Initialize variables to store order details
$total_price = 0;
$order_details = [];

// Process the ordered items and insert them into the orders table
foreach ($ordered_items as $food_id) {
    // Retrieve food details based on food_id
    $food_query = "SELECT * FROM food WHERE F_ID = $food_id";
    $food_result = $conn->query($food_query);

    if (!$food_result) {
        die("Database query error: " . $conn->error);
    }

    $food_data = $food_result->fetch_assoc();
    $food_name = $food_data['name'];
    $food_price = $food_data['price'];

    // Calculate the total price
    $total_price += $food_price;

    // Add order details to the array
    $order_details[] = [
        'food_name' => $food_name,
        'food_price' => $food_price,
    ];

    // Insert the order into the orders table
        $insert_query = "INSERT INTO orders (F_ID, C_ID, order_status, price, quantity, order_date, R_ID, address)
                    VALUES ($food_id, $C_ID, 'Pending', $food_price, 1, NOW(), $restaurant_id, '$address')";

    $insert_result = $conn->query($insert_query);

    if (!$insert_result) {
        die("Order insertion error: " . $conn->error);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="CSS/style.css">
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        h2 {
            margin-top: 20px;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 5px 0;
        }

        h3 {
            color: #007bff;
            margin-top: 20px;
        }

        p {
            margin-top: 10px;
            font-size: 18px;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Order Confirmation</h1>
        <p>Thank you for placing your order! Here are the details:</p>

        <h2>Order Details</h2>
        <ul>
            <?php foreach ($order_details as $item) : ?>
                <li><?= $item['food_name']; ?> - ฿<?= $item['food_price']; ?></li>
            <?php endforeach; ?>
        </ul>

        <h3>Total Price: ฿<?= $total_price; ?></h3>

        <p>Your order has been placed successfully. We will deliver it to you shortly.</p>

        <h4>You can find more Information in your profile.</h4>

        <p><a href="customer_dashboard.php">Back to Home</a></p>
    </div>
</body>
</html>
