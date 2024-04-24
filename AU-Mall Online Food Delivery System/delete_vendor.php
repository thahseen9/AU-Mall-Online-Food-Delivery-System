<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $r_id = $_POST["r_id"]; // Get the vendor's R_ID to delete

    // Check if the R_ID exists in the restaurants table
    $check_sql = "SELECT * FROM restaurants WHERE R_ID = $r_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // R_ID exists in the restaurants table, proceed with deletion
        $delete_sql = "DELETE FROM vendor WHERE R_ID = $r_id";

        if ($conn->query($delete_sql) === TRUE) {
            echo "Vendor with R_ID $r_id has been deleted successfully.";
        } else {
            echo "Error deleting vendor: " . $conn->error;
        }
    } else {
        echo "Vendor with R_ID $r_id does not exist in the restaurants table.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Vendor</title>
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
<header>
    <div class="header">
        <img src="Images/V_logo.jpeg" alt="logo" class="logo" />
        <div class="center-text">Delete Vendor</div>
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
    <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delete Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
        <label for="r_id">Vendor's R_ID:</label>
        <input type="text" name="r_id" required><br>

        <input type="submit" value="Delete Vendor">
    </form>
</div>
</body>
</html>
