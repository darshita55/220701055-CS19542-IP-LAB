<?php
include 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cid']) && isset($_POST['atype'])) {
    $cid = intval($_POST['cid']);
    $atype = $conn->real_escape_string($_POST['atype']);
    $balance = 0.00; // Default balance

    // Validate account type
    if ($atype !== 'S' && $atype !== 'C') {
        die("Invalid account type. Must be 'S' for savings or 'C' for current.");
    }

    $sql = "INSERT INTO ACCOUNT (ATYPE, BALANCE, CID) VALUES ('$atype', '$balance', '$cid')";

    if ($conn->query($sql) === TRUE) {
        echo "New account created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<form method="post" action="insert_account.php">
    <label for="cid">Customer ID:</label>
    <input type="number" id="cid" name="cid" required>
    <label for="atype">Account Type (S/C):</label>
    <input type="text" id="atype" name="atype" required>
    <input type="submit" value="Add Account">
</form>