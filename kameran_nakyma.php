<?php
session_start();

// Handle sign out if form is submitted
if (isset($_POST['sign_out'])) {
    // Destroy the session
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect to login page after sign out
    header('Location: http://localhost/harjoitukset/valvonta_kamera/login.php');
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo 'Et ole kirjautunut sisään';
    exit;
}

// Get the username from the session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown User'; // Default if not set
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kameran Näkymä</title>
</head>
<body>
    <!-- Personalized greeting -->
    <h1>Tervetuloa kameranäkymään, <?php echo htmlspecialchars($username); ?>!</h1>

    <!-- Sign Out Button -->
    <form method="post">
        <input type="submit" name="sign_out" value="Sign Out">
    </form>

    <!-- Camera view iframe -->
    <iframe src="http://10.184.3.247:1880/ui" width="1024" height="768"></iframe>
</body>
</html>
