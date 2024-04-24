<?php
include 'connect.php';

$customer = null; // Initialize the customer variable

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_customer_id"])) {
    $search_customer_id = $_POST["search_customer_id"]; // Get the customer ID to search for

    if (!empty($search_customer_id)) {
        // Query to retrieve customer information by ID
        $search_sql = "SELECT * FROM customer WHERE C_ID = $search_customer_id";
        $result = $conn->query($search_sql);

        if ($result->num_rows > 0) {
            // Customer found, retrieve their data
            $customer = $result->fetch_assoc();
        } else {
            echo "Customer with ID $search_customer_id not found.";
        }
    } else {
        echo "Please enter a valid customer ID.";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_customer"])) {
    // Form submitted to update customer information
    $customer_id = $_POST["customer_id"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $password = $_POST["password"];

    $sql = "UPDATE customer SET fullname = '$fullname', email = '$email', 
            contact = '$contact', address = '$address', password = '$password' 
            WHERE C_ID = $customer_id";

    if ($conn->query($sql) === TRUE) {
        echo "Customer updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Customer</title>
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>

<header>
    <div class="header">
        <img src="Images/V_logo.jpeg" alt="logo" class="logo" />
        <div class="center-text">Update Customer</div>
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
    <h2>Update Customer</h2>
        <label for="search_customer_id">Search Customer by ID:</label>
        <input type="text" name="search_customer_id" required>
        <input type="submit" value="Search">
    </form>


    <?php if ($customer !== null): ?>
    <form class = "add-form" method="post" action="">
        <input type="hidden" name="customer_id" value="<?php echo $customer['C_ID']; ?>">
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" value="<?php echo $customer['fullname']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $customer['email']; ?>" required><br>

        <label for="contact">Contact:</label>
        <input type="text" name="contact" value="<?php echo $customer['contact']; ?>" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $customer['address']; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo $customer['password']; ?>" required><br>

        <input type="submit" name="update_customer" value="Update Customer">
    </form>
    <?php endif; ?>

</body>
</html>
