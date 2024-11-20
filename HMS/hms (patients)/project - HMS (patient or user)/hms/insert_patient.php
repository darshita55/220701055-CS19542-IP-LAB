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
$name = $_POST['name'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$medical_history = $_POST['medical_history'];
$allergies = $_POST['allergies'];
$medications = $_POST['medications'];
$previous_treatments = $_POST['previous_treatments'];

// Insert data into the patients table
$sql = "INSERT INTO patient (patient_id, name, contact_number, email, medical_history, allergies, medications, previous_treatments) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $patient_id, $name, $contact_number, $email, $medical_history, $allergies, $medications, $previous_treatments);

if ($stmt->execute()) {
    echo "New patient added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>