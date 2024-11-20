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

// Check if ID is set
if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];

    // Fetch appointment details
    $sql = "SELECT * FROM appointments WHERE id = $appointment_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $new_date = $_POST['appointment_date'];
            $new_reason = $_POST['reason'];

            // Update appointment
            $update_sql = "UPDATE appointments SET appointment_date = '$new_date', reason = '$new_reason' WHERE id = $appointment_id";
            if ($conn->query($update_sql) === TRUE) {
                // Redirect to view appointments after a successful update
                header('Location: view_appointment.php');
                exit; // Exit to ensure no further code is executed
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    } else {
        echo "No appointment found with the provided ID.";
        exit; // Stop execution if no appointment is found
    }
} else {
    echo "No appointment ID provided.";
    exit; // Stop execution if no ID is provided
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Reschedule Appointment</title>
</head>
<body>
    <h1>Reschedule Appointment</h1>

    <form action="reschedule_appointments.php?id=<?php echo $appointment_id; ?>" method="post">
        <label for="appointment_date">Appointment Date:</label>
        <input type="datetime-local" name="appointment_date" value="<?php echo date('Y-m-d\TH:i', strtotime($appointment['appointment_date'])); ?>" required>

        <label for="reason">Reason:</label>
        <textarea name="reason" required><?php echo $appointment['reason']; ?></textarea>

        <input type="submit" value="Reschedule Appointment">
    </form>
</body>
</html>
