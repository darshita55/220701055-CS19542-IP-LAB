<?php
include 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cname'])) {
    $cname = $conn->real_escape_string($_POST['cname']);

    $sql = "INSERT INTO CUSTOMER (CNAME) VALUES ('$cname')";

    if ($conn->query($sql) === TRUE) {
        echo "New customer created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<form method="post" action="insert_customer.php">
    <label for="cname">Customer Name:</label>
    <input type="text" id="cname" name="cname" required>
    <input type="submit" value="Add Customer">
</form>