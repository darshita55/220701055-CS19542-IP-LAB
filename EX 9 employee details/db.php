<?php
// db.php
$servername = "localhost"; // Your server name
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "employee_db"; // Your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>