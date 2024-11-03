<?php
include 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ename = $conn->real_escape_string($_POST['ename']);
    $desig = $conn->real_escape_string($_POST['desig']);
    $dept = $conn->real_escape_string($_POST['dept']);
    $doj = $conn->real_escape_string($_POST['doj']);
    $salary = floatval($_POST['salary']); // Convert salary to float

    $sql = "INSERT INTO EMPDETAILS (ENAME, DESIG, DEPT, DOJ, SALARY) VALUES ('$ename', '$desig', '$dept', '$doj', '$salary')";

    if ($conn->query($sql) === TRUE) {
        echo "New employee created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<form method="post" action="insert_employee.php">
    <label for="ename">Employee Name:</label>
    <input type="text" id="ename" name="ename" required>
    <label for="desig">Designation:</label>
    <input type="text" id="desig" name="desig">
    <label for="dept">Department:</label>
    <input type="text" id="dept" name="dept">
    <label for="doj">Date of Joining:</label>
    <input type="date" id="doj" name="doj" required>
    <label for="salary">Salary:</label>
    <input type="number" id="salary" name="salary" required step="0.01">
    <input type="submit" value="Add Employee">
</form>