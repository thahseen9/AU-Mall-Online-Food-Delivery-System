<?php
// Include your database connection file (e.g., 'connect.php')
include 'connect.php';

// Retrieve R_ID from the URL
if (isset($_GET['R_ID'])) {
    $restaurantID = $_GET['R_ID'];
} else {
    echo "Restaurant ID not provided.";
    exit;
}

// Function to update order status
function updateOrderStatus($conn, $orderID, $newStatus)
{
    // Trim the newStatus value to remove any leading or trailing spaces
    $newStatus = trim($newStatus);

    // Debugging statement
    echo "Updating order status to: " . $newStatus;

    $updateQuery = "UPDATE orders SET order_status = ? WHERE order_ID = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $newStatus, $orderID);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Handle updating order status (you can keep this as is)
if (isset($_POST['updateStatus'])) {
    $orderID = $_POST['orderID'];
    $newStatus = $_POST['newStatus'];
    if (updateOrderStatus($conn, $orderID, $newStatus)) {
        echo " Order status updated successfully.";
    } else {
        echo "Error updating order status.";
    }
}

// Handle searching by recent order date (you can keep this as is)
if (isset($_POST['searchRecent'])) {
    $orderBy = "ORDER BY order_date DESC";
} else {
    $orderBy = ""; // Default order
}

// Modify the SQL query to filter by R_ID
$query = "SELECT o.order_ID, o.order_status, o.order_date, o.F_ID, o.price, o.quantity, o.address, f.name AS food_name, c.fullname AS customer_name
          FROM orders AS o
          LEFT JOIN food AS f ON o.F_ID = f.F_ID
          LEFT JOIN customer AS c ON o.C_ID = c.C_ID
          WHERE o.R_ID = ? $orderBy";

// Prepare and execute the query
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $restaurantID);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Orders</title>
    <link rel="stylesheet" type="text/css" href="CSS/vendor.css">
</head>
<body>
<header>
<div class="header">
<div class="right-text"><a href="Index.php">Logout</a></div> <br>
        <div>
        <img src="Images/V_logo.jpeg" alt="logo" class="logo" />
        <div class="center-text">Vendor Dashboard</div>

        </div>
    </div>
    </header>
    <nav>
        <ul>
        <li><a href="vendor_homepage.php?R_ID=<?php echo $restaurant_id; ?>">Home</a></li>
            <li><a href="add_food.php?R_ID=<?php echo $restaurant_id; ?>">Add Menu</a></li>
            <li><a href="edit_food.php?R_ID=<?php echo $restaurant_id; ?>">Edit Menu</a></li>
            <li><a href="delete_food.php?R_ID=<?php echo $restaurant_id; ?>">Delete Menu</a></li>
            <li><a href="Order_vendor.php?R_ID=<?php echo $restaurant_id; ?>">Orders</a></li>
            <li><a href="Index.php">Logout</a></li>
        </ul>
    </nav>
    <section style="background-color:aliceblue; padding: 20px;"><h1 style="text-align: center;">Vendor Order Management</h1></section>

    <form method="post">
        <label for="searchRecent">Search by Recent Order Date:</label>
        <input type="checkbox" name="searchRecent" id="searchRecent">
        <input type="submit" value="Search">
    </form>

    <table>
        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Food Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Current Order States</th>
            <th>Update Status</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['order_ID']}</td>";
            echo "<td>{$row['order_date']}</td>";
            echo "<td>{$row['food_name']}</td>";
            echo "<td>{$row['price']}</td>";
            echo "<td>{$row['quantity']}</td>";
            echo "<td>{$row['customer_name']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['order_status']}</td>";
            echo "<td>
                    <form method='post'>
                        <input type='hidden' name='orderID' value='{$row['order_ID']}'>
                        <select name='newStatus'>
                            <option value='Pending'>Pending</option>
                            <option value='Delivered'>Delivered</option>
                            <option value='Cancelled'>Cancelled</option>
                        </select>
                        <input type='submit' name='updateStatus' value='Update'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>