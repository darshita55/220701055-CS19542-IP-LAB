<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from form
$appointment_id = $_POST['appointment_id'];
$doctor_name = $_POST['doctor_name'];
$appointment_date = $_POST['appointment_date'];
$reason = $_POST['reason'];

// Update the appointment in the database
$sql = "UPDATE appointments SET doctor_name = ?, appointment_date = ?, reason = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $doctor_name, $appointment_date, $reason, $appointment_id);

if ($stmt->execute()) {
    echo "Appointment updated successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
