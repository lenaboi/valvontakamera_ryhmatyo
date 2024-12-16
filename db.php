<?php
$servername = "localhost";   // Tietokannan palvelin
$username = "root";          // Tietokannan käyttäjänimi
$password = "";              // Tietokannan salasana
$dbname = "valvonta_kamera"; // Tietokannan nimi

// Luo yhteys
$conn = new mysqli($servername, $username, $password, $dbname);

// Tarkista yhteys
if ($conn->connect_error) {
    die("Yhteyden muodostaminen epäonnistui: " . $conn->connect_error);
}
?>
