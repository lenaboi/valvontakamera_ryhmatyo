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


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./style.css"> <!-- Link to your custom CSS file -->
</head>

<body>
    <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> 

        <div class="signin">
            <div class="content">
                <h2>Sign Up</h2>
                <div class="form">
                    <!-- Sign Up Form -->
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
                            <input type="password" name="confirm_salasana" required>
                            <i>Confirm Password</i>
                        </div>

                        <div class="inputBox">
                            <input type="submit" name="rekisterointi" value="Sign Up">
                        </div>
                    </form>

                    <div class="links">
                        <a href="http://localhost/harjoitukset/valvonta_kamera/login.php" id="showLogin">Login</a> <!-- Link to show login form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
