<?php
// Start a PHP session
session_start();

if (isset($_GET['R_ID'])) {
    $restaurant_id = $_GET['R_ID'];

    // Store the restaurant_id in the session as the expected_restaurant_id
    $_SESSION['expected_restaurant_id'] = $restaurant_id;

    // Include your database connection file (e.g., 'connect.php')
    include 'connect.php';
    // Debugging statements
    echo "Restaurant ID: " . $restaurant_id . "<br>";
    // Query to fetch food items for the specified restaurant
    $food_query = "SELECT * FROM food WHERE R_ID = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($food_query);
    
    // Bind the restaurant_id as a parameter
    $stmt->bind_param("i", $restaurant_id);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $food_result = $stmt->get_result();
    
    // Close the statement
    $stmt->close();

    // Query to fetch orders for the specified restaurant
    $order_query = "SELECT * FROM orders WHERE R_ID = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($order_query);
    
    // Bind the restaurant_id as a parameter
    $stmt->bind_param("i", $restaurant_id);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $order_result = $stmt->get_result();
    
    // Close the statement
    $stmt->close();
} else {
    // Handle the case where 'R_ID' is not provided in the URL
    echo "Restaurant ID not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard</title>
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
    </nav>



    <section class="food-section">
        <?php
        if (isset($food_result) && $food_result->num_rows > 0) {
            echo "<h2>Food Menu</h2>";
            echo "<table>";
            echo "<tr><th>Food ID</th><th>Name</th><th>Price</th><th>Description</th><th>Image</th></tr>";

            while ($food_row = $food_result->fetch_assoc()) {
                $food_id = $food_row['F_ID'];
                $food_name = $food_row['name'];
                $food_price = $food_row['price'];
                $food_description = $food_row['description'];
                $food_image_path = $food_row['images_path'];

                echo "<tr>";
                echo "<td>$food_id</td>";
                echo "<td>$food_name</td>";
                echo "<td>$food_price</td>";
                echo "<td>$food_description</td>";
                echo "<td><img src='$food_image_path' alt='$food_name' style='max-width: 100px; max-height: 100px;' /></td>"; // Adjust the max-width and max-height as needed
                echo "</tr>";

            }

            echo "</table>";
        } else {
            echo "<p>No food items found for this restaurant.</p>";
        }
        ?>
    </section>

    <section class="order-section">
        <?php
        if (isset($order_result) && $order_result->num_rows > 0) {
            echo "<h2>Orders</h2>";
            echo "<table>";
            echo "<tr><th>Order ID</th><th>Order Status</th><th>Order Date</th><th>Food ID</th><th>Price</th><th>Quantity</th><th>Address of Customer</th></tr>";

            while ($order_row = $order_result->fetch_assoc()) {
                $order_ID = $order_row['order_ID'];
                $order_status = $order_row['order_status'];
                $order_date = $order_row['order_date'];
                $food_ID = $order_row['F_ID'];
                $item_price = $order_row['price'];
                $quantity = $order_row['quantity'];
                $address = $order_row['address'];

                echo "<tr>";
                echo "<td>$order_ID</td>";
                echo "<td>$order_status</td>";
                echo "<td>$order_date</td>";
                echo "<td>$food_ID</td>";
                echo "<td>$item_price</td>";
                echo "<td>$quantity</td>";
                echo "<td>$address</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No orders found for this restaurant.</p>";
        }
        ?>
    </section>

    <footer>
    </footer>
</body>
</html>