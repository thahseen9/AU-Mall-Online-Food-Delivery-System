<?php
session_start(); // Start a PHP session
if (isset($_GET['R_ID'])) {
    $restaurant_id = $_GET['R_ID'];

    // Store the restaurant_id in the session as the expected_restaurant_id
    $_SESSION['expected_restaurant_id'] = $restaurant_id;

    // Include your database connection file (e.g., 'connect.php')
    include 'connect.php';
}

$name = $price = $description = $options = $restaurant_id = "";
$nameErr = $priceErr = $descriptionErr = $restaurant_idErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $price = test_input($_POST["price"]);
    $description = test_input($_POST["description"]);
    $options = test_input($_POST["options"]);
    $restaurant_id = test_input($_POST["restaurant_id"]);

    // Check if fields are empty
    if (empty($name)) {
        $nameErr = "Name is required";
    }
    if (empty($price)) {
        $priceErr = "Price is required";
    }
    if (empty($description)) {
        $descriptionErr = "Description is required";
    }
    if (empty($restaurant_id)) {
        $restaurant_idErr = "Restaurant ID is required";
    }

    // If there are no errors, insert the food item into the database
    if (empty($nameErr) && empty($priceErr) && empty($descriptionErr) && empty($restaurant_idErr)) {
        $sql = "INSERT INTO food (name, price, description, R_ID, options) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $price, $description, $restaurant_id, $options);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Food item added successfully"; // Store success message in session
            header("Location: add_food.php"); // Redirect to the same page
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food</title>
    <link rel="stylesheet" href="CSS/vendor.css">
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

    <!-- Display success message if set in session -->
    <?php if (isset($_SESSION['success_message'])) { ?>
        <div class="success-alert">
            <?php echo $_SESSION['success_message']; ?>
        </div>
        <?php
        // Remove the success message from session
        unset($_SESSION['success_message']);
    }
    ?>
<section style="background-color:aliceblue; padding: 20px;"><h1 style="text-align: center;">Add Menu</h1></section>
<center>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label> <br>
        <input type="text" name="name" id="name">
        <span class="error"><?php echo $nameErr; ?></span><br><br>

        <label for="price">Price:</label> <br>
        <input type="text" name="price" id="price">
        <span class="error"><?php echo $priceErr; ?></span><br><br>

        <label for="description">Description:</label> <br>
        <textarea name="description" id="description"></textarea>
        <span class="error"><?php echo $descriptionErr; ?></span><br><br>

        <label for="restaurant_id">Restaurant ID:</label> <br>
        <input type="text" name="restaurant_id" id="restaurant_id">
        <span class="error"><?php echo $restaurant_idErr; ?></span><br><br>

        <label for="options">Options:</label> <br>
        <select name="options" id="options">
            <option value="ENABLE">ENABLE</option>
            <option value="DISABLE">DISABLE</option>
        </select>
        <br><br>

        <input type="submit" name="submit" value="Add Food">
    </form>
    </center>
</body>
</html>
