<?php
include 'connect.php'; // Include your database connection script

$registrationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    // Check if the email address is already registered
    $emailCheckQuery = "SELECT COUNT(*) AS email_count FROM customer WHERE email = '$email'";
    $emailCheckResult = $conn->query($emailCheckQuery);
    $emailCount = $emailCheckResult->fetch_assoc()['email_count'];

    if ($emailCount > 0) {
        $registrationMessage = "Email address is already registered. Please use a different email.";
    } else {
        // Insert the user data into the database without hashing the password
        $insertQuery = "INSERT INTO customer (fullname, email, contact, address, password) 
                        VALUES ('$fullname', '$email', '$contact', '$address', '$password')";

        if ($conn->query($insertQuery) === TRUE) {
            // Registration successful, redirect to Login_customer.php
            header("Location: Login_customer.php");
            exit; // Make sure to exit to prevent further script execution
        } else {
            $registrationMessage = "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 400px;
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
        input[type="email"],
        input[type="password"] {
            width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            width: 40%;
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
            text-align: center;
            margin-top: 10px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #FF5733; /* Error message color (e.g., red) */
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Customer Registration</h2>
    <?php
    if (!empty($registrationMessage)) {
        echo '<p class="error-message">' . $registrationMessage . '</p>';
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="contact">Contact:</label>
        <input type="text" name="contact" required><br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="Login_customer.php">Login here</a></p>
</body>
</html>
