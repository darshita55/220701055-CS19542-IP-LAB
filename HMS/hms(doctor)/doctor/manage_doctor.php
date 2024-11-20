<?php
// Database connection
// manage_doctor.php
include '../include/db_connect.php'; // Adjust the path as needed

$host = 'localhost';
$db = 'hms';
$user = 'root';
$pass = ''; // Use your database password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Insert doctor into the database
    $stmt = $conn->prepare("INSERT INTO doctors (name, specialty, phone, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $specialty, $phone, $email);

    if ($stmt->execute()) {
        echo "New doctor added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch all doctors to display
$result = $conn->query("SELECT * FROM doctors");
if ($result->num_rows > 0) {
    echo "<ul class='list-group mt-3'>";
    while ($row = $result->fetch_assoc()) {
        echo "<li class='list-group-item'>" . $row['name'] . " - " . $row['specialty'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No doctors found.";
}

$conn->close();
?>