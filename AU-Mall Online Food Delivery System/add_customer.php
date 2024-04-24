<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $password = $_POST["password"];

    $sql = "INSERT INTO customer (fullname, email, contact, address, password) 
            VALUES ('$fullname', '$email', '$contact', '$address', '$password')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            echo "Customer added successfully. Customer ID (C_ID): <strong>" . $last_id . "</strong>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Add Customer</title>
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
<header>
    <div class="header">
        <img src="Images/V_logo.jpeg" alt="logo" class="logo" />
        <div class="center-text">Add Customer</div>
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
    <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Customer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
        <label for="fullname">Full Name:</label><br>
        <input type="text" name="fullname" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="contact">Contact:</label>
        <input type="text" name="contact" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Add Customer">
    </form>
    <div>
</body>
</html>
