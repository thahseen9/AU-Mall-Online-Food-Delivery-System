<?php
// Start a session to access user data
session_start();

// Check if the user is logged in
if (!isset($_SESSION["C_ID"])) {
    // User is not logged in, redirect to the login page
    header("Location: Login_customer.php");
    exit();
}

// Retrieve user data from session
$C_ID = $_SESSION["C_ID"];
$fullname = $_SESSION["fullname"];
$email = $_SESSION["email"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AU Mall</title>
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: rgb(100, 30, 30);
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .right-text a:hover {
            color: #C49799; 
        }
        nav ul li a:hover {
            color: #C49799; 
        }
        .dropdown-content a:hover {
            color: whitesmoke; 
            background-color: #8B1E3F ;
        }


    </style>
</head>
<body>
    <header>
        <table class="header-table">
            <tr class="header-row">
                <td><img src="Images/AuLogo.jpeg" alt="logo" class="logo" /></td>
                <td class="center-text">AU Mall Cafeteria</td>
                <td class="admin-vendor-cell">
                    <!-- Display "Hi! [fullname]" next to "Vendor" -->
                    <span class="right-text" style="text-decoration: none; color: antiquewhite;  margin-left: 20px; font-weight:bold;">
                    <a href="profile_customer.php"><?php echo "Hi! " . $fullname; ?></a></span>
                    <span class="right-text" style="text-decoration: none; color: antiquewhite;"><a href="Index.php">Logout</a></span>
                </td>
            </tr>
        </table>
    </header>
    <nav>
        <ul>
            <li><a href="customer_dashboard.php">Home</a></li>
            <li class="dropdown">
                <a href="menu.php" class="dropbtn">Shops</a>
                <div class="dropdown-content">
                    <?php
                    include 'connect.php';

                    // Query to fetch restaurant names
                    $query = "SELECT R_ID, name FROM restaurants";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $restaurant_name = $row['name'];
                            $restaurant_id = $row['R_ID'];
                            echo "<a href='menu.php?R_ID=$restaurant_id'>$restaurant_name</a>";
                        }
                    }
                    ?>
                </div>
            </li>
            <li><a href="aboutUs.php">About Us</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
        <nav style="color: rgb(124, 30, 30); text-align:center; font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size:24px; background-color:antiquewhite">Menu</nav>
  <section class="shop-section">
    <div class="shop-card restaurant-card"">
        <a href='menu.php?R_ID=1001' class="shop-link">
            <img src="Images/taiwan-chicken-noodle-soup.jpeg" alt="Shop 1" class="shop-image" />
            <p>Taiwanese Restaurant</p>
        </a>
    </div>
    <div class="shop-card restaurant-card"">
        <a href='menu.php?R_ID=1002' class="shop-link">
            <img src="Images/Dim-sum-china.jpeg" alt="Shop 2" class="shop-image" />
            <p>Chinese Restaurant</p>
        </a>
    </div>
    <div class="shop-card restaurant-card"">
        <a href='menu.php?R_ID=1003' class="shop-link">
            <img src="Images/Pad-krapow-thai.jpg" alt="Shop 3" class="shop-image" />
            <p>Thai Restaurant</p>
        </a>
    </div>
</section>
<section  class="shop-section">
<div class="shop-card restaurant-card"">
        <a href='menu.php?R_ID=1004' class="shop-link">
            <img src="Images/Garlic-naan-india.jpeg" alt="Shop 3" class="shop-image" />
            <p>Indian Restaurant</p>
        </a>
    </div>
    <div class="shop-card restaurant-card"">
        <a href='menu.php?R_ID=1005' class="shop-link">
            <img src="Images/Goi cuon vietnam.jpeg" alt="Shop 3" class="shop-image" />
            <p>Vietnamese Restaurant</p>
        </a>
    </div>
    <div class="shop-card restaurant-card"">
        <a href='menu.php?R_ID=1006' class="shop-link">
            <img src="Images/Mee goreng mamak malay.jpeg" alt="Shop 3" class="shop-image" />
            <p>Malaysian Restaurant</p>
        </a>
    </div>
</section>
<footer id="contact">
        <table>
            <tr>
                <td class="contact-info">Contact Information</td>
            </tr>
            <tr>
                <td>+66 2 723 2323</td>
            </tr>
            <tr>
                <td><a href="mailto:abac@au.edu" class="email-link">abac@au.edu</a></td>
            </tr>
            <tr>
                <td>Mailing Address : <br>
                    88 Moo 8 Bang Na-Trad Km. 26, <br>
                    Bangsaothong <br>
                    Samuthprakarn 10570 Thailand</td>
            </tr>
            <tr>
                <td>&copy; 2023 AU Mall. All rights reserved.</td>
            </tr>
        </table>
    </footer>
</body>
</html>
