<?php
session_start();
include("connect.php"); // Assuming the connection code is in the "connect.php" file

if (isset($_GET['R_ID'])) {
    $restaurantID = $_GET['R_ID'];
} else {
    echo "Restaurant ID not provided.";
    exit;
}

$f_id = "";
$f_idErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["f_id"])) {
    $f_id = $_POST["f_id"];
    if (empty($f_id)) {
        $_SESSION['error_message'] = "Food ID is required";
    } else {
        $sql = "DELETE FROM food WHERE F_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $f_id);
        $stmt->execute();
        $_SESSION['success_message'] = "Food item deleted successfully";
        header("Location: delete_food.php");
        exit();
    }
}

$conn->close(); // Close the database connection
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Food</title>
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
    <section style="background-color:aliceblue; padding: 20px;"><h1 style="text-align: center;">Delete Menu</h1></section>
<center>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="f_id">Food ID:</label>
        <input type="text" name="f_id" id="f_id" value="<?php echo htmlspecialchars($f_id); ?>">
        <input type="submit" name="search" value="Delete">
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])): ?>
        <!-- Display additional information here if needed -->
    <?php endif; ?>
    <?php
    if (!empty($f_idErr)) {
        echo '<div class="error-message">' . $f_idErr . '</div>';
    }
    if (isset($_SESSION['success_message'])) {
        echo '<div class="success-message">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    ?>
</center>
</body>
</html>
