<?php
// Lähetä viesti MQTT:hen, jos käyttäjä haluaa käynnistää kameran
if ($_POST['action'] == 'start_camera') {
    // Lähetä viesti Node-REDille, että kamera käynnistyy
    // MQTT-viesti voi olla muotoa: 'start_camera' tai muu tarpeen mukaan
    $mqttClient->publish("kamera/command", "start_camera");
}
?>
