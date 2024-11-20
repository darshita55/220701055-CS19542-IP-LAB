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
            // Delete appointment
            $delete_sql = "DELETE FROM appointments WHERE id = $appointment_id";
            if ($conn->query($delete_sql) === TRUE) {
                echo "Appointment canceled successfully.";
                header('Location: view_appointment.php');
                exit; // Exit to ensure no further code is executed
            } else {
                echo "Error canceling appointment: " . $conn->error;
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
    <title>Cancel Appointment</title>
</head>

<body>
    <h1>Cancel Appointment</h1>

    <p>Are you sure you want to cancel the following appointment?</p>

    <p><strong>Appointment Date:</strong> <?php echo date('Y-m-d H:i', strtotime($appointment['appointment_date'])); ?>
    </p>
    <p><strong>Reason:</strong> <?php echo $appointment['reason']; ?></p>

    <form action="cancel_appointments.php?id=<?php echo $appointment_id; ?>" method="post">
        <input type="submit" value="Yes, Cancel Appointment">
    </form>

    <form action="index.php" method="get">
        <input type="submit" value="No, Go Back">
    </form>
</body>

</html>