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
$appointment_date = $_POST['appointment_date'];
$reason = $_POST['reason'];

// Prepare the SQL statement
$sql = "INSERT INTO appointments (patient_id, appointment_date, reason) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('MySQL prepare error: ' . $conn->error); // Output error if prepare fails
}

// Bind parameters (ensure the data types match the actual fields in your DB)
$stmt->bind_param("sss", $patient_id, $appointment_date, $reason);

// Execute the statement
if ($stmt->execute()) {
    echo "Appointment booked successfully.";
} else {
    echo "Error: " . $stmt->error; // Display any error that occurs during execution
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>