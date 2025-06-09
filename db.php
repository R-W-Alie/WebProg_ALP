<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "sri";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Timezone configuration
if ($conn) {
    date_default_timezone_set('Asia/Jakarta'); // Set PHP timezone
    $conn->query("SET time_zone = '+07:00'"); // Set MySQL timezone to match
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>