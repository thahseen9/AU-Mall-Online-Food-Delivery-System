<?php
include("connect.php");

$login_error = ""; // Initialize the login error message

if (isset($_POST['login'])) {
    $restaurant_id = $_POST["restaurant_id"];
    
    // Check if the 'password' key exists in the $_POST array
    if (isset($_POST["password"])) {
        $password = $_POST["password"];

        $stmt = $conn->prepare("SELECT * FROM vendor WHERE R_ID = ?");
        $stmt->bind_param("s", $restaurant_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Check if the 'password' key exists in the $row array
            if (isset($row['password'])) {
                $stored_password = $row['password']; // Stored plain text password

                if ($password === $stored_password) {
                    // Redirect to vendor_homepage.php and pass the R_ID as a parameter
                    header("location: vendor_homepage.php?R_ID=$restaurant_id");
                    // Redirect to add_food.php and pass the R_ID as a parameter

                    exit();
                } else {
                    $login_error = "Sorry, Invalid Restaurant ID or Password. Please enter correct credentials.";
                }
                
            } else {
                $login_error = "Sorry, Invalid Restaurant ID. Please enter correct credentials.";
            }
        } else {
            $login_error = "Sorry, Invalid Restaurant ID. Please enter correct credentials.";
        }

        $stmt->close();
    } else {
        $login_error = "Password field is empty. Please enter a password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            color: white;
            margin: 0;
            background-color: rgb(124, 30, 30);
        }
        table {
            border-collapse: collapse;
            width: 50%;
            margin: auto;
        }
        th {
            text-align: left;
        }
 
        td {
            text-align: center;
        }
 
        p {
            color: white;
            text-align: center;
            margin-top: 10px;
        }

        a {
        text-decoration: none;
        color:greenyellow;
        }

        a:hover {
            text-decoration: underline;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }
    </style>
    <script>
        function validateForm() {
            var restaurantIdInput = document.querySelector('input[name="restaurant_id"]');
            var passwordInput = document.querySelector('input[name="password"]');
            
            // Check if any of the fields are empty
            if (restaurantIdInput.value === "" || passwordInput.value === "") {
                alert("All fields are required.");
                return false; // Prevent form submission
            }
            return true;
        }
    </script>
</head>
<body>
    <form method="post" action="" onsubmit="return validateForm();">
        <fieldset>
            <legend align="center">
                <h1 align="center">Restaurant Login</h1>
            </legend>
            <?php if (!empty($login_error)) { ?>
                <hr>
                <font color="red"><b>
                    <h3><?php echo $login_error; ?></h3>
                </b></font>
                <hr>
            <?php } ?>
            <table width="50%" border="0" align="center" style="border:none;">
                <tr>
                    <th height="40"><label for="restaurant_id">
                        Restaurant ID</label>
                    </th>
                    <td><input type="text" name="restaurant_id"
                            id="restaurant_id" required>
                        </td>
                </tr>
                <tr>
                    <th height="40"><label for="password">
                        Password
                    </label>
                    </th>
                    <td><input type="password"
                        name="password" id="password" required></td>
                </tr>
                <tr>
                    <td colspan="2" height="40"><input
                        type="submit" name="login"
                        value="Login"></td>
                </tr>
            </table>
        </fieldset>
    </form>
    <p>Want to be a Vendor? Don't have an account? Contact Admin by <a href="mailto:abac@au.edu" class="email-link">abac@au.edu</a> </a></p>
</body>
</html>
