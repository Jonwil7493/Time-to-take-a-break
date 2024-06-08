<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="View/style.css">
</head>
<body>
    <?php if (isset($_GET['error'])): ?>
        <p style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>
    <form action="../Controller/signupController.php" method="post">
        <h2>Sign Up</h2>
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>
        <br>
        <p>Please enter a unique username</p>
        <br>
    
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <p>Password must be 8 characters long, contain at least one special character and one number.</p>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>
        <button type="submit"><a href="loginView.php"></a>Sign Up</button>
    </form>
    <p>Already have an account? <a href="loginView.php">Login</a></p>
</body>
</html>
