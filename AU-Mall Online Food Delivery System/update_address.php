<?php
session_start();

if (!isset($_SESSION["C_ID"])) {
    header("Location: Login_customer.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php';

    $C_ID = $_SESSION["C_ID"];
    $new_address = $_POST["address"];

    // Update the address in the database
    $update_query = "UPDATE customer SET address = '$new_address' WHERE C_ID = $C_ID";
    if ($conn->query($update_query)) {
        // Address updated successfully
        header("Location: profile_customer.php");
        exit();
    } else {
        echo "Error updating address: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Address</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        /* Header styles */
        header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        /* Navigation styles */
        nav {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        /* Profile section styles */
        .profile-section {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .profile-section h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        /* Form styles */
        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 50%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Footer styles */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        /* Footer links */
        footer a {
            color: #fff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <section class="profile-section">
        <h2>Change Address</h2>
        <form method="post" action="">
            <label for="address">New Address:</label></br>
            <input type="text" id="address" name="address" required><br>

            <input type="submit" value="Update Address">
        </form>
    </section>
</body>
</html>
