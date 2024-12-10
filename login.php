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

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./style.css"> <!-- Link to your custom CSS file -->
</head>

<body>
    <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> 

        <div class="signin">
            <div class="content">
                <h2>Sign In</h2>
                <div class="form">
                    <!-- Login Form -->
                    <form method="post">
                        <div class="inputBox">
                            <input type="text" name="username" required>
                            <i>Username</i>
                        </div>

                        <div class="inputBox">
                            <input type="password" name="salasana" required>
                            <i>Password</i>
                        </div>

                        <div class="inputBox">
                            <input type="submit" name="kirjautuminen" value="Login">
                        </div>
                    </form>

                    <div class="links">
                        <a href="http://localhost/harjoitukset/valvonta_kamera/signup.php" id="showSignUp">Sign Up</a> <!-- Link to show sign-up form -->
                    </div>
                </div>
            </div>
        </div>

    </section>

</body>

</html>
