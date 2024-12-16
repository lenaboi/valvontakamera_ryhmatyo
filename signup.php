<?php
// Start the session
session_start();

// Include the database connection
include('db.php');  // Database connection

// Sign Up (Register a new user)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rekisterointi'])) {
    $username = $_POST['username'];
    $salasana = $_POST['salasana'];
    $confirmPassword = $_POST['confirm_salasana'];

    // Check if the passwords match
    if ($salasana !== $confirmPassword) {
        $_SESSION['message'] = 'Salasanat eivät täsmää!';  // Passwords do not match
        header('Location: account_status.php');
        exit();
    } else {
        // Check if the username already exists
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // If the username already exists, show a message
            $_SESSION['message'] = 'Käyttäjätunnus on jo käytössä!';  // Username already taken
            header('Location: account_status.php');
            exit();
        } else {
            // Hash the password before saving it
            $hashedPassword = password_hash($salasana, PASSWORD_DEFAULT);

            // Insert the new user into the database
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $username, $hashedPassword);
            if ($stmt->execute()) {
                $_SESSION['message'] = 'Kiitos, tilin luominen onnistui';  // Registration successful

                // Optionally, automatically log the user in
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['username'] = $username;

                // Redirect to 'account_status.php' with the success message
                header('Location: account_status.php');
                exit();
            } else {
                $_SESSION['message'] = 'Rekisteröinti epäonnistui! Yritä uudelleen.';  // Registration failed
                header('Location: account_status.php');
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekisteröidy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Taustavideo -->
    <video autoplay muted loop id="background-video">
        <source src="tausta.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Rekisteröintilomake -->
    <form method="post">
        <div id="loginbox">
            <h2>Rekisteröidy</h2>

            <div class="inputBox">
                <input type="text" name="username" required id="input" placeholder="Käyttäjätunnus">
                <label for="username">Käyttäjätunnus</label>
            </div>

            <div class="inputBox">
                <input type="password" name="salasana" required id="input" placeholder="Salasana">
                <label for="salasana">Salasana</label>
            </div>

            <div class="inputBox">
                <input type="password" name="confirm_salasana" required id="input" placeholder="Vahvista salasana">
                <label for="confirm_salasana">Vahvista salasana</label>
            </div>

            <div class="inputBox">
                <input type="submit" name="rekisterointi" value="Rekisteröidy" id="loginbutton">
            </div>

            <div class="links">
                <a href="login.php">Onko sinulla jo tili? Kirjaudu sisään</a>
            </div>
        </div>
    </form>
    
</body>
</html>
