<?php
session_start();

// Handle sign out if form is submitted
if (isset($_POST['sign_out'])) {
    session_unset();
    session_destroy();
    header('Location: http://localhost/php_harjoitukset/valvontakamera_ryhmatyo-master/login.php');
    exit();
}

if (!isset($_SESSION['user_id'])) {
    echo 'Et ole kirjautunut sisään';
    exit;
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown User';
?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kameran Näkymä</title>
    <link rel="stylesheet" href="koti.css">
</head>
<body>
<video autoplay muted loop id="background-video">
    <source src="tausta.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>
<!-- Sign Out Button -->
<form method="post" class="sign-out-form">
    <input type="submit" name="sign_out" value="Kirjaudu ulos">
</form>

<!-- Main Content -->
<div class="container">
    <h1>Tervetuloa kameranäkymään, <?php echo htmlspecialchars($username); ?>!</h1>
    <iframe src="http://10.184.5.99:1880/ui"></iframe>
</div>
</body>
</html>
