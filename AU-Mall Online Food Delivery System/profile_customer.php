<?php
// Start a session to access user data
session_start();

// Check if the user is logged in
if (!isset($_SESSION["C_ID"])) {
    // User is not logged in, redirect to the login page
    header("Location: Login_customer.php");
    exit();
}

// Retrieve user data from session
$C_ID = $_SESSION["C_ID"];
$fullname = $_SESSION["fullname"];
$email = $_SESSION["email"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Reset some default styles */
body, h1, h2, p, ul, li {
    margin: 0;
    padding: 0;
}

/* Apply some basic styles to the body */
body {
    font-family: Arial, sans-serif;
    background-color: #007bff;
    margin: 0;
    padding: 0;
}

/* Header styles */
header {
    background-color: #007bff;
    color: #fff;
    text-align: center;
    padding: 20px 0;
}

/* Navigation styles */
nav {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}

nav a {
    color: #fff;
    text-decoration: none;
    margin: 0 10px;
}

/* Profile section styles */
.profile-section {
    background-color: #fff;
    padding: 20px;
    margin: 20px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

.profile-section h2 {
    font-size: 24px;
    margin-bottom: 15px;
}

/* Links in profile section */
.profile-section a {
    color: #007bff;
    text-decoration: none;
}

.profile-section a:hover {
    text-decoration: underline;
}

/* Order history table styles */
.order-history {
    background-color: white;
    padding: 20px;
    margin: 20px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

.order-history h2 {
    font-size: 24px;
    margin-bottom: 15px;
}

table {
    width: 100%;
    border: rgb(124, 30, 30);
    margin-top: 20px;
    background-color: whitesmoke;
}

th, td {
    padding: 8px 12px;
    text-align: left;
    border-bottom: 1px solid rgb(124, 30, 30);
}

th {
    background-color: black;
    color: white;
}

/* Footer styles */
footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}

/* Footer links */
footer a {
    color: #fff;
    text-decoration: none;
}

footer a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <header>
    </header>

    <nav>
    </nav>

    <section class="profile-section">
        <h2>My Profile</h2>
        <p><strong>Full Name:</strong> <?php echo $fullname; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>

        <!-- Update Password and Address Links -->
        <p><a href="update_password.php">Change Password</a></p>
        <p><a href="update_address.php">Change Address</a></p>
        <!-- End Update Password and Address Links -->
    </section>

    <section class="order-history">
        <h2>Order History</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Restaurant</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <!-- Add more table headers for additional order details if needed -->
            </tr>
            <?php
            include 'connect.php';

            // Query to fetch user's orders
            $order_query = "SELECT orders.*, food.name AS item_name, food.price AS item_price, orders.quantity FROM orders
                            INNER JOIN food ON orders.F_ID = food.F_ID
                            WHERE orders.C_ID = $C_ID";

            $order_result = $conn->query($order_query);

            if ($order_result->num_rows > 0) {
                while ($order_row = $order_result->fetch_assoc()) {
                    $order_ID = $order_row['order_ID'];
                    $order_status = $order_row['order_status'];
                    $order_date = $order_row['order_date'];
                    $restaurant_id = $order_row['R_ID'];
                    $item_name = $order_row['item_name'];
                    $item_price = $order_row['item_price'];
                    $quantity = $order_row['quantity'];

                    // Query to get restaurant name
                    $restaurant_query = "SELECT name FROM restaurants WHERE R_ID = $restaurant_id";
                    $restaurant_result = $conn->query($restaurant_query);
                    $restaurant_name = ($restaurant_result->num_rows > 0) ? $restaurant_result->fetch_assoc()['name'] : 'N/A';

                    echo "<tr>";
                    echo "<td>$order_ID</td>";
                    echo "<td>$order_status</td>";
                    echo "<td>$order_date</td>";
                    echo "<td>$restaurant_name</td>";
                    echo "<td>$item_name</td>";
                    echo "<td>$item_price</td>";
                    echo "<td>$quantity</td>";
                    // Add more table cells for additional order details if needed
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No order history found.</td></tr>";
            }
            ?>
        </table>
    </section>

    <footer>
        <!-- Add your footer content here -->
    </footer>
</body>
</html>