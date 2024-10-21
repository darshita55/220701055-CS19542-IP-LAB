<?php
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP is usually empty
$dbname = "hms"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from form
$patient_id = $_POST['patient_id'];
$doctor_name = $_POST['doctor_name'];
$appointment_date = $_POST['appointment_date'];
$reason = $_POST['reason'];

// Insert data into the appointments table
$sql = "INSERT INTO appointments (patient_id, doctor_name, appointment_date, reason) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $patient_id, $doctor_name, $appointment_date, $reason);

if ($stmt->execute()) {
    echo "Appointment booked successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
