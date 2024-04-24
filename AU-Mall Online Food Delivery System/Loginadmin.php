<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
                body {
            color: white;
            margin: 0;
            background-color: #1176ba;;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .header a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        .admin-panel {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .admin-form {
            background-color: #1176bb;;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 500px; 
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 90%;
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

        p {
            color: red;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .alert-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
    <script>
        function showErrorMessage() {
            var usernameInput = document.querySelector('input[name="username"]');
            var passwordInput = document.querySelector('input[name="password"]');
            var alertMessage = document.getElementById('alertMessage');
            
            // Check if username and password are correct
            if (usernameInput.value === "Admin" && passwordInput.value === "1234") {
                return true; // Allow form submission
            } else {
                alertMessage.innerText = "Incorrect username or password.";
                return false; // Prevent form submission
            }
        }
    </script>
</head>
<body>
    <div class="admin-panel">
        <form class="admin-form" method="POST" action="Admin.php" onsubmit="return showErrorMessage();">
            <h2>&nbsp;&nbsp;&nbsp;&nbsp;Admin Login&nbsp;&nbsp;&nbsp;&nbsp;</h2><br>
            <p class="alert-message" id="alertMessage"></p>
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required> <br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>