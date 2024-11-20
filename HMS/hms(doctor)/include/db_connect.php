<?php
$host = 'localhost';
$db = 'hospital_management';
$user = 'root';
$pass = ''; // Use your database password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>