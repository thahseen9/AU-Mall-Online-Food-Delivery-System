<?php
session_start();

if (!isset($_SESSION["C_ID"])) {
    header("Location: Login_customer.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php';

    $C_ID = $_SESSION["C_ID"];
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];

    // Fetch the existing password from the database
    $get_password_query = "SELECT password FROM customer WHERE C_ID = $C_ID";
    $get_password_result = $conn->query($get_password_query);

    if ($get_password_result->num_rows > 0) {
        $row = $get_password_result->fetch_assoc();
        $stored_password = $row["password"];

        // Verify the old password (plain text comparison)
        if ($old_password === $stored_password) {
            // Update the password in the database (plain text)
            $update_query = "UPDATE customer SET password = '$new_password' WHERE C_ID = $C_ID";
            if ($conn->query($update_query)) {
                // Password updated successfully
                header("Location: profile_customer.php");
                exit();
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "Old password is incorrect.";
        }
    } else {
        echo "User not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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

        input[type="password"] {
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
        <h2>Change Password</h2>
        <form method="post" action="">
            <label for="old_password">Old Password:</label> <br>
            <input type="password" id="old_password" name="old_password" required><br>

            <label for="new_password">New Password:</label> <br>
            <input type="password" id="new_password" name="new_password" required><br>

            <input type="submit" value="Update Password">
        </form>
    </section>
</body>
</html>
