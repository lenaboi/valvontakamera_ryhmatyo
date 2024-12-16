<?php
// Start the session
session_start();

// Include the database connection
include('db.php');  // Tietokannan yhteys

// Kirjautuminen (Login)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kirjautuminen'])) {
    $username = $_POST['username'];
    $salasana = $_POST['salasana'];

    // Etsitään käyttäjä tietokannasta (Search for the user in the database)
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo 'Käyttäjätunnusta ei löytynyt!';  // Username not found
    } else {
        $row = $result->fetch_assoc();
        // Vertaillaan syötetty salasana ja tietokannan salasana (Compare password)
        if (password_verify($salasana, $row['password'])) {
            // Kirjautuminen onnistui (Login successful)
            echo 'Kirjautuminen onnistui!';

            // Store user ID in session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;

            // Redirect to 'kameran_nakyma.php' after successful login
            header('Location: kameran_nakyma.php');
            exit();  // Ensure the script stops after the redirect
        } else {
            echo 'Väärä salasana!';  // Incorrect password
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekisteröityminen ja kirjautuminen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Taustavideo -->
    <video autoplay muted loop id="background-video">
        <source src="tausta.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Kirjautumislomake -->
    <form method="post">
        <div id="loginbox">
            <h2>Kirjaudu sisään</h2>
            <div class="inputBox">
                <input type="text" name="username" required id="input" placeholder="Käyttäjätunnus">
                <label for="username">Käyttäjätunnus</label>
            </div>

            <div class="inputBox">
                <input type="password" name="salasana" required id="input" placeholder="Salasana">
                <label for="salasana">Salasana</label>
            </div>

            <div class="inputBox">
                <input type="submit" name="kirjautuminen" value="Kirjaudu sisään" id="loginbutton">
            </div>

            <div class="links">
                <a href="signup.php">Ei tiliä? Rekisteröidy</a>
            </div>
        </div>
    </form>
    
</body>
</html>


