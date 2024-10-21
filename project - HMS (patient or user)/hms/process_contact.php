<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Here you can add code to send the email or save the message to a database
    // For example, using the mail() function or database queries
    // mail($to, $subject, $message, $headers);

    echo "Message sent successfully!";
} else {
    echo "Invalid request.";
}
?>
