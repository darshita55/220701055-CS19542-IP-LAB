<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Add your password if any
$dbname = "hms";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch appointments
$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>View Appointments</title>
</head>
<body>
    <h1>View Appointments</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Patient ID</th>
            <th>Doctor Name</th>
            <th>Appointment Date</th>
            <th>Reason</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['patient_id']}</td>
                        <td>{$row['doctor_name']}</td>
                        <td>{$row['appointment_date']}</td>
                        <td>{$row['reason']}</td>
                        <td>
                            <a href='reschedule_appointments.php?id={$row['id']}'>Reschedule</a> |
                            <a href='cancel_appointments.php?id={$row['id']}'>Cancel</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No appointments found.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
