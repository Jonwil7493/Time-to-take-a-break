<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: loginView.php");
    exit;
}

// If the form is submitted, save preferences to the session
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['overall_time_frame'] = $_POST['overall_time_frame'];
    $_SESSION['number_of_breaks'] = $_POST['number_of_breaks'];
    $_SESSION['duration_of_each_break'] = $_POST['duration_of_each_break'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <!-- Link the CSS file -->
    <link rel="stylesheet" href="View/style.css">
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>

    <p><a href="timeframe.php">View TimeFrames</a></p>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <h2>Your Preferences</h2>
        <p>Overall Time Frame: <?php echo htmlspecialchars($_SESSION['overall_time_frame']); ?> minutes</p>
        <p>Number of Breaks: <?php echo htmlspecialchars($_SESSION['number_of_breaks']); ?></p>
        <p>Duration of Each Break: <?php echo htmlspecialchars($_SESSION['duration_of_each_break']); ?> minutes</p>
    <?php endif; ?>

    <div class="timer" id="timer">00:00:00</div>
    <button class="button" onclick="startTimer()">Start Timer</button>

    <p><a href="loginView.php">Logout</a></p>

    <script>
        let timer;
        let isRunning = false;

        function startTimer() {
            if (isRunning) {
                clearInterval(timer);
                isRunning = false;
                document.querySelector('.button').innerText = 'Start Timer';
            } else {
                let startTime = Date.now();
                timer = setInterval(() => {
                    let elapsedTime = Date.now() - startTime;
                    document.getElementById('timer').innerText = formatTime(elapsedTime);
                }, 1000);
                isRunning = true;
                document.querySelector('.button').innerText = 'Stop Timer';
            }
        }

        function formatTime(ms) {
            let totalSeconds = Math.floor(ms / 1000);
            let hours = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
            let minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
            let seconds = String(totalSeconds % 60).padStart(2, '0');
            return `${hours}:${minutes}:${seconds}`;
        }
    </script>
</body>
</html>
