<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Link to the CSS file -->
    <title>Add Patient</title>
</head>
<body>
    <h1>Add Patient</h1>
    <form action="insert_patient.php" method="post">
        <label for="patient_id">Patient ID:</label>
        <input type="text" id="patient_id" name="patient_id" required>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        
        <label for="medical_history">Medical History:</label>
        <textarea id="medical_history" name="medical_history" rows="4"></textarea>

        <label for="allergies">Allergies:</label>
        <textarea id="allergies" name="allergies" rows="4"></textarea>
        
        <label for="medications">Medications:</label>
        <textarea id="medications" name="medications" rows="4"></textarea>

        <label for="previous_treatments">Previous Treatments:</label>
        <textarea id="previous_treatments" name="previous_treatments" rows="4"></textarea>

        <input type="submit" value="Add Patient">
    </form>
</body>
</html>
