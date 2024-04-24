<?php
session_start();
include("connect.php"); // Assuming the connection code is in the "connect.php" file

$orderID = "";
$orderDetails = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $orderID = $_POST["orderID"];

    // Fetch order details based on the entered order_ID using mysqli
    $sql = "SELECT * FROM orders WHERE order_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $orderID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $orderDetails = $result->fetch_assoc();
    } else {
        $orderDetails = [];
    }
}

// Fetch all orders using mysqli
$sqlAllOrders = "SELECT * FROM orders";
$resultAllOrders = $conn->query($sqlAllOrders);
$allOrders = [];

if ($resultAllOrders->num_rows > 0) {
    while ($row = $resultAllOrders->fetch_assoc()) {
        $allOrders[] = $row;
    }
}

// Close the mysqli connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
<header>
    <div class="header">
        <img src="Images/V_logo.jpeg" alt="logo" class="logo" />
        <div class="center-text">Orders</div>
    </div>
</header>
<nav>
    <ul>
        <li><a href="Admin.php">Home</a></li>
        <li class="dropdown">
            <a href="#">Customer</a>
            <div class="dropdown-content">
                <a href="add_customer.php">Add</a>
                <a href="edit_customer.php">Update</a>
                <a href="delete_customer.php">Delete</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Vendor</a>
            <div class="dropdown-content">
                <a href="add_vendor.php">Add</a>
                <a href="edit_vendor.php">Update</a>
                <a href="delete_vendor.php">Delete</a>
            </div>
        </li>
        <li><a href="Orders.php">Orders</a></li>
    </ul>
</nav>
    <h1>Order Details</h1>
    
    <form class = "add-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="orderID">Search by Order ID:</label>
        <input type="text" name="orderID" id="orderID" value="<?php echo htmlspecialchars($orderID); ?>">
        <input type="submit" name="search" value="Search">
    </form>

    <?php if (!empty($orderDetails)) : ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Food ID</th>
                    <th>Customer ID</th>
                    <th>Order Status</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Order Date</th>
                    <th>Restaurant ID</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $orderDetails['order_ID']; ?></td>
                    <td><?php echo $orderDetails['F_ID']; ?></td>
                    <td><?php echo $orderDetails['C_ID']; ?></td>
                    <td><?php echo $orderDetails['order_status']; ?></td>
                    <td><?php echo $orderDetails['price']; ?></td>
                    <td><?php echo $orderDetails['quantity']; ?></td>
                    <td><?php echo $orderDetails['order_date']; ?></td>
                    <td><?php echo $orderDetails['R_ID']; ?></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>

    <h2>All Orders</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Food ID</th>
                <th>Customer ID</th>
                <th>Order Status</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Order Date</th>
                <th>Restaurant ID</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allOrders as $order) : ?>
                <tr>
                    <td><?php echo $order['order_ID']; ?></td>
                    <td><?php echo $order['F_ID']; ?></td>
                    <td><?php echo $order['C_ID']; ?></td>
                    <td><?php echo $order['order_status']; ?></td>
                    <td><?php echo $order['price']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td><?php echo $order['R_ID']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
