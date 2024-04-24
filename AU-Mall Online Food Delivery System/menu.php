<?php
include 'connect.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION["C_ID"])) {
    // User is not logged in, redirect to the login page
    header("Location: Login_customer.php");
    exit();
}

// Retrieve the C_ID from the session
$customer_id = $_SESSION["C_ID"];

if (isset($_GET['R_ID'])) {
    $restaurant_id = $_GET['R_ID'];

    // Query to fetch menu items for the selected restaurant
    $menu_query = "SELECT * FROM food WHERE R_ID = $restaurant_id";
    $menu_result = $conn->query($menu_query);

    if (!$menu_result) {
        die("Database query error: " . $conn->error);
    }
} else {
    echo "Please select a restaurant.";
    exit(); // Exit to prevent further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: gainsboro;
            margin: 0;
            padding: 0;
        }
        .menu-section {
            text-align: center;
        }

        .menu-item {
            display: inline-block;
            width: 300px; /* Set the desired width for menu items */
            margin: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .menu-item-image {
            max-width: 100%;
            height: auto;
        }

        .order-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<section class="menu-section">
    <h2>Menu Items</h2>

    <form id="order-form" method="post" action="confirm_order.php">
    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
    <input type="hidden" name="restaurant_id" value="<?php echo $restaurant_id; ?>">

    <?php
    if (isset($menu_result) && $menu_result->num_rows > 0) {
        while ($row = $menu_result->fetch_assoc()) {
            $food_id = $row['F_ID'];
            $food_name = $row['name'];
            $food_price = $row['price'];
            $food_description = $row['description'];
            $food_image = $row['images_path'];

            echo "<div class='menu-item'>";
            echo "<img src='$food_image' alt='$food_name' class='menu-item-image'>";
            echo "<h3>$food_name</h3>";
            echo "<p><strong>Price:</strong> $food_price</p>";
            echo "<p><strong>Description:</strong> $food_description</p>";
            echo "<label for='food_item_$food_id'>Order this item:</label>";
            echo "<input type='checkbox' id='food_item_$food_id' name='ordered_items[]' value='$food_id'>";
            echo "</div>";
        }
    } else {
        echo "No menu items found for this restaurant.";
    }
    ?>

    <!-- Order button to confirm the selected items -->
    <button type="submit" id="confirm-order" class="order-button">Order</button>
</form>

</section>

<footer>
    <?php
    // Retrieve restaurant details based on the restaurant ID
    $restaurant_query = "SELECT * FROM restaurants WHERE R_ID = $restaurant_id";
    $restaurant_result = $conn->query($restaurant_query);

    if ($restaurant_result->num_rows > 0) {
        $restaurant_data = $restaurant_result->fetch_assoc();
        $restaurant_name = $restaurant_data['name'];
        $restaurant_email = $restaurant_data['email'];
        $restaurant_contact = $restaurant_data['contact'];
        $restaurant_address = $restaurant_data['address'];

        echo "<table>";
        echo "<tr><td><strong>Restaurant Name:</strong></td><td>$restaurant_name</td></tr>";
        echo "<tr><td><strong>Email:</strong></td><td>$restaurant_email</td></tr>";
        echo "<tr><td><strong>Contact:</strong></td><td>$restaurant_contact</td></tr>";
        echo "<tr><td><strong>Address:</strong></td><td>$restaurant_address</td></tr>";
        echo "</table>";
    } else {
        echo "Restaurant details not found.";
    }
    ?>
</footer>

<!-- JavaScript to handle the order confirmation -->
<script>
    document.getElementById('confirm-order').addEventListener('click', function () {
        const orderedItems = document.querySelectorAll('input[name="ordered_items[]"]:checked');

        if (orderedItems.length === 0) {
            alert("Please select at least one item to order.");
            return false;
        }
    });
</script>
</body>
</html>
</body>
</html>
