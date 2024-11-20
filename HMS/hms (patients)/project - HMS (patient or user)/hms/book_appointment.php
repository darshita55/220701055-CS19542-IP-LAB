<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Link to the CSS file -->
    <title>Book Appointment</title>
</head>

<body>
    <h1>Book Appointment</h1>
    <form action="insert_appointment.php" method="post">
        <label for="patient_id">Patient ID:</label>
        <input type="text" id="patient_id" name="patient_id" required>

        <label for="appointment_date">Appointment Date:</label>
        <input type="datetime-local" id="appointment_date" name="appointment_date" required>

        <label for="reason">Reason for Appointment:</label>
        <textarea id="reason" name="reason" rows="4"></textarea>

        <input type="submit" value="Book Appointment">
    </form>
</body>

</html>