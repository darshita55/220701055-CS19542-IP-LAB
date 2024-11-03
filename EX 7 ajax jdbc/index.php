<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Enter your MySQL password here
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission and fetch selected student's details
$studentDetails = "";
if (isset($_POST['reg_no'])) {
    $reg_no = $_POST['reg_no'];
    $sql = "SELECT * FROM students WHERE reg_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $reg_no);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if ($student) {
        $studentDetails = "Name: " . $student['name'] . "<br>" .
            "Age: " . $student['age'] . "<br>" .
            "Department: " . $student['department'];
    } else {
        $studentDetails = "Student details not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Details</title>
</head>

<body>
    <h2>Select Student Registration Number</h2>
    <form method="POST" action="">
        <select name="reg_no" onchange="this.form.submit()">
            <option value="">Select a Registration Number</option>
            <?php
            // Populate dropdown with registration numbers
            $sql = "SELECT reg_no FROM students";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $selected = (isset($_POST['reg_no']) && $_POST['reg_no'] == $row['reg_no']) ? 'selected' : '';
                echo '<option value="' . $row['reg_no'] . '" ' . $selected . '>' . $row['reg_no'] . '</option>';
            }
            ?>
        </select>
    </form>

    <h3>Student Details</h3>
    <p><?php echo $studentDetails; ?></p>
</body>

</html>

<?php
$conn->close(); // Close the connection at the end
?>