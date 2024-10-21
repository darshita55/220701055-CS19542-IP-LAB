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

// Get the patient's ID (this would typically come from a session after login)
$patient_id = 'PATIENT_ID_HERE'; // Replace with actual patient ID from session or other source

// Retrieve appointments for the patient
$sql = "SELECT * FROM appointments WHERE patient_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Link to the CSS file -->
    <title>Manage Appointments</title>
</head>
<body>
    <h1>Your Appointments</h1>

    <table>
        <tr>
            <th>Doctor Name</th>
            <th>Appointment Date</th>
            <th>Reason</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['doctor_name']); ?></td>
            <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
            <td><?php echo htmlspecialchars($row['reason']); ?></td>
            <td>
                <a href="reschedule_appointments.php?id=<?php echo $row['id']; ?>">Reschedule</a> | 
                <a href="cancel_appointments.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to cancel this appointment?');">Cancel</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <?php
    // Close connection
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
