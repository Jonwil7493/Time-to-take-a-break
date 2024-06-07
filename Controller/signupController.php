<?php
require_once '../Model/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST["fullname"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Log the received input
    error_log("Received signup request with Fullname: $fullname, Username: $username");

    if ($password != $confirm_password) {
        error_log("Passwords do not match");
        header("Location: ../View/signupView.php?error=Passwords do not match");
        exit();
    }

    $sql = "SELECT Username FROM user WHERE Username = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        error_log("Number of rows found with username: " . $stmt->num_rows);

        if ($stmt->num_rows > 0) {
            error_log("Username already taken: $username");
            header("Location: ../View/signupView.php?error=Username already taken");
            exit();
        } else {
            $stmt->close();
            $sql = "INSERT INTO user (Fullname, Username, Password) VALUES (?, ?, ?)";
            if ($stmt = $mysqli->prepare($sql)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Log the hashed password before storing
                error_log("Hashed password for $username: $hashed_password");

                // Ensure the number of "s" characters matches the number of parameters
                $stmt->bind_param("sss", $fullname, $username, $hashed_password);
                if ($stmt->execute()) {
                    error_log("User registered successfully: $username");
                    header("Location: ../View/loginView.php?message=Registration successful");
                    exit();
                } else {
                    error_log("Error executing statement: " . $stmt->error);
                    header("Location: ../View/signupView.php?error=Something went wrong. Please try again.");
                    exit();
                }
            } else {
                error_log("SQL preparation error: " . $mysqli->error);
                header("Location: ../View/signupView.php?error=SQL preparation error");
                exit();
            }
        }
    } else {
        error_log("SQL preparation error: " . $mysqli->error);
        header("Location: ../View/signupView.php?error=SQL preparation error");
        exit();
    }
}
$mysqli->close();
