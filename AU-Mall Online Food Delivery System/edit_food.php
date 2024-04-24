<?php
include 'connect.php';

if (count($_POST) > 0) {
    // Check if the update form is submitted
    if (isset($_POST['update'])) {
        $F_ID = $_POST['F_ID'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $R_ID = $_POST['R_ID'];
        $images_path = $_POST['images_path'];
        $options = $_POST['options'];

        // Construct the UPDATE query
        $updateQuery = "UPDATE food SET 
            name='$name', 
            price='$price', 
            description='$description', 
            R_ID='$R_ID', 
            images_path='$images_path', 
            options='$options' 
            WHERE F_ID='$F_ID'";

        $query_run = mysqli_query($conn, $updateQuery);

        if ($query_run) {
            echo "Food item updated successfully.";
        } else {
            echo "Error updating food item: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Food</title>
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
            <li><a href="Index.php">Logout</a></li>
        </ul>
    </nav>
    <div id="success-alert" class="success-alert" style="display: none;">
        Food item updated successfully.
    </div>
    <section style="background-color:aliceblue; padding: 20px;"><h1 style="text-align: center;">Edit Menu</h1></section>
    <center>
    <form action="" method="POST">
        <input type="text" name="F_ID" placeholder="Enter Food ID for search" /><br>
        <input type="submit" name="search" value="Search" />
    </form>
    </center>
    <?php
    include 'connect.php';
    if (isset($_POST['F_ID'])) {
        $F_ID = $_POST['F_ID'];

        // Use a prepared statement to prevent SQL injection
        $foodQuery = "SELECT * FROM food WHERE F_ID = ?";
        $stmt = $conn->prepare($foodQuery);
        $stmt->bind_param("i", $F_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <form action="" method="POST">
                <input type="hidden" name="F_ID" value="<?php echo $row['F_ID'] ?>" /><br>
                Name: <br> <center> <input type="text" name="name" value="<?php echo $row['name']; ?>" /> </center> <br>
                Price: <br> <center> <input type="text" name="price" value="<?php echo $row['price']; ?>" /> </center> <br>
                Description: <br> <center> <input type="text" name="description" value="<?php echo $row['description']; ?>" /> </center> <br>
                R_ID: <br> <center> <input type="text" name="R_ID" value="<?php echo $row['R_ID']; ?>" /> </center> </center> <br>
                Image path: <br> <center> <input type="text" name="images_path" value="<?php echo $row['images_path']; ?>" /> </center> <br>
                Options: <br> <center> <input type="text" name="options" value="<?php echo $row['options']; ?>" /> </center> <br>

                <input type="submit" name="update" value="Update">
            </form>
    <?php
        } else {
            echo "Food item not found.";
        }
        $stmt->close();
    }
    ?>
    <script>
    <?php if (isset($_POST['update'])): ?>
        document.getElementById("success-alert").style.display = "block";
    <?php endif; ?>
</script>
</body>
</html>
