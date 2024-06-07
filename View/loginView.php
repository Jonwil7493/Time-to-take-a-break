<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="View/style.css">
</head>
<body>
    <h2>Login</h2>

    <?php
    if (isset($_GET['error'])) {
        echo '<p style="color:red;">' . htmlspecialchars($_GET['error']) . '</p>';
    }
    if (isset($_GET['message'])) {
        echo '<p style="color:green;">' . htmlspecialchars($_GET['message']) . '</p>';
    }
    ?>

    <form action="../Controller/loginController.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="checkbox" onclick="showPassword()">Show Password
        <br>
        <button type="submit"><a href="Welcome.php"></a>Login</button>
    </form>

    <p>Don't have an account? <a href="signupView.php">Sign up here</a></p>

    <script>
        function showPassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>
</html>
