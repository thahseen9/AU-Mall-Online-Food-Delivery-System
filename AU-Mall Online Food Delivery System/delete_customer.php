<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST["customer_id"]; // Get the customer ID to delete

    // Check if the customer ID exists before attempting to delete
    $check_sql = "SELECT * FROM customer WHERE C_ID = $customer_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Customer with the specified ID exists, proceed with deletion
        $delete_sql = "DELETE FROM customer WHERE C_ID = $customer_id";

        if ($conn->query($delete_sql) === TRUE) {
            echo "Customer with ID $customer_id has been deleted successfully.";
        } else {
            echo "Error deleting customer: " . $conn->error;
        }
    } else {
        echo "Customer with ID $customer_id does not exist.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Customer</title>
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
<header>
    <div class="header">
        <img src="Images/V_logo.jpeg" alt="logo" class="logo" />
        <div class="center-text">Delete Customer</div>
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

<div class="add-user">
    <form class = "add-form" method="post" action="">
    <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delete Customer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
        <label for="customer_id">Customer ID:</label>
        <input type="text" name="customer_id" required><br>

        <input type="submit" value="Delete Customer">
    </form>
<div>
</body>
</html>
