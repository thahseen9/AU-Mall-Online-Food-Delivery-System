<?php
// Start a session to store user data if login is successful
session_start();

// Include the database connection file (if not in the same directory, specify the correct path)
require_once("connect.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query to check if the email and password match
    $query = "SELECT * FROM customer WHERE email = ? AND password = ?";
    
    // Prepare the query
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("ss", $email, $password);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Login successful, retrieve user data
            $row = $result->fetch_assoc();

            // Store user data in the session
            $_SESSION["C_ID"] = $row["C_ID"];
            $_SESSION["fullname"] = $row["fullname"];
            $_SESSION["email"] = $row["email"];
            $_SESSION['address'] = $row["address"];

            // Redirect to customer_dashboard.php
            header("Location: customer_dashboard.php");
            exit();
        } else {
            // Invalid email or password, show an alert
            echo '<script>alert("Incorrect email or password.");</script>';
        }
        
        // Close the prepared statement
        $stmt->close();
    } else {
        // Database query error
        echo '<script>alert("Database error. Please try again later.");</script>';
    }
}

// Close the database connection (if not closed automatically)
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:  rgb(124, 30, 30);
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #fff;
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            width: 50%;
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            color: white;
            text-align: center;
            margin-top: 10px;
        }

        a {
        text-decoration: none;
        color: gainsboro;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Login - Customer</h1>
    <form method="post" action="Login_customer.php">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>

    <p>Don't have an account? <a href="register_customer.php">Register here</a></p>
</body>
</html>
