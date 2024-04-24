<?php
include 'connect.php';

$vendor = null; // Initialize the vendor variable

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_vendor_id"])) {
    $search_vendor_id = $_POST["search_vendor_id"]; // Get the vendor's associated restaurant ID to search for

    // Check if the restaurant ID exists in the vendors table
    $check_sql = "SELECT * FROM vendor WHERE R_ID = $search_vendor_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Vendor with the specified R_ID exists, retrieve their data
        $vendor = $check_result->fetch_assoc();
    } else {
        echo "Vendor with Restaurant ID $search_vendor_id does not exist.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_vendor"])) {
    // Form submitted to update vendor information
    $restaurant_id = $_POST["restaurant_id"]; // Get the restaurant ID (R_ID)
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $password = $_POST["password"];

    $update_sql = "UPDATE vendor SET fullname = '$fullname', email = '$email', 
            contact = '$contact', address = '$address', password = '$password' 
            WHERE R_ID = $restaurant_id"; // Use R_ID for updating

    if ($conn->query($update_sql) === TRUE) {
        echo "Vendor information updated successfully.";
    } else {
        echo "Error updating vendor: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Vendor</title>
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
<header>
    <div class="header">
        <img src="Images/V_logo.jpeg" alt="logo" class="logo" />
        <div class="center-text">Update Vendor</div>
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

    
    <form class = "add-form" method="post" action="">
    <h2>Update Vendor</h2>
        <label for="search_vendor_id">Search Vendor by Restaurant ID:</label>
        <input type="text" name="search_vendor_id" required>
        <input type="submit" value="Search">
    </form>

    <?php if ($vendor !== null): ?>
    <form class = "add-form" method="post" action="">
        <input type="hidden" name="restaurant_id" value="<?php echo $vendor['R_ID']; ?>">
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" value="<?php echo $vendor['fullname']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $vendor['email']; ?>" required><br>

        <label for="contact">Contact:</label>
        <input type="text" name="contact" value="<?php echo $vendor['contact']; ?>" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $vendor['address']; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo $vendor['password']; ?>" required><br>

        <input type="submit" name="update_vendor" value="Update Vendor">
    </form>
    <?php endif; ?>
</body>
</html>
