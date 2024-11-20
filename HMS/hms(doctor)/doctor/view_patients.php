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

// Query to get patients
$sql = "SELECT id, name, email, phone, address FROM patients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>View Patients</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    h1 {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    a {
        display: block;
        margin: 20px 0;
        text-align: center;
        text-decoration: none;
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }

    a:hover {
        background-color: #45a049;
    }
    </style>
</head>

<body>
    <h1>View Patients</h1>
    <table>
        <tr>
            <th>Patient ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["phone"] . "</td>
                    <td>" . $row["address"] . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No patients found</td></tr>";
        }
        ?>
    </table>
    <a href="doctor_form.php">Go back to home</a>
</body>

</html>

<?php
$conn->close();
?>