<!-- contact_process.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Simple validation (for demonstration purposes)
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Here, you would typically send an email or save the data to a database
        echo "Thank you, $name. We have received your message.";
        echo "<meta http-equiv='refresh' content='10;url=index.php'>";
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>
