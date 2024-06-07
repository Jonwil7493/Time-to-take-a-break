<?php
require_once '../Model/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Log the received username and password
    error_log("Received login request with Username: $username");

    $sql = "SELECT Username, Password FROM user WHERE Username = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        error_log("Number of rows found: " . $stmt->num_rows);

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($db_username, $hashed_password);
            $stmt->fetch();

            // Log the hashed password from the database
            error_log("Hashed password from DB for $username: $hashed_password");

            if (password_verify($password, $hashed_password)) {
                // Password matches, redirect to welcome page
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $db_username;
                error_log("Password verification succeeded for username: $username");

                header("Location: ../View/welcome.php");
                exit();
            } else {
                // Password doesn't match
                error_log("Password verification failed for username: $username");
                header("Location: ../View/loginView.php?error=Invalid credentials");
                exit();
            }
        } else {
            // No user found with the provided username
            error_log("No user found with username: $username");
            header("Location: ../View/loginView.php?error=Invalid credentials");
            exit();
        }
    } else {
        // Database query error
        error_log("Database query error: " . $mysqli->error);
        header("Location: ../View/loginView.php?error=Something went wrong. Please try again.");
        exit();
    }
}
$mysqli->close();
