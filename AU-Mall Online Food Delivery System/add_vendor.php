<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $r_id = $_POST["r_id"]; // Get the restaurant ID to associate the vendor

    // Check if the provided R_ID exists in the 'restaurants' table
    $check_sql = "SELECT * FROM restaurants WHERE R_ID = $r_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // R_ID exists in the 'restaurants' table, proceed with adding the vendor
        $sql = "INSERT INTO vendor (R_ID, fullname, email, contact, address, password) 
                VALUES ('$r_id', '$fullname', '$email', '$contact', '$address', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Vendor added successfully.";
        } else {
            echo "Error adding vendor: " . $conn->error;
        }
    } else {
        echo "Restaurant with ID $r_id does not exist. Please enter a valid R_ID.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Vendor</title>
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
<header>
    <div class="header">
        <img src="Images/V_logo.jpeg" alt="logo" class="logo" />
        <div class="center-text">Add Vendor</div>
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
    <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
        <label for="r_id">Restaurant ID:</label>
        <input type="text" name="r_id" required><br>

        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="contact">Contact:</label>
        <input type="text" name="contact" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Add Vendor">
    </form>
</div>
</body>
</html>
