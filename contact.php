<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate the data
    if (empty($name) || empty($email) || empty($message)) {
        echo "<p class='error'>All fields are required.</p>";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p class='error'>Invalid email format.</p>";
        exit;
    }

    // Prepare the email
    $to = "promentor97@gmail.com"; // Replace with your email address
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "<p class='message'>Thank you for contacting us, $name. We will get back to you soon!</p>";
    } else {
        echo "<p class='error'>There was an error sending your message. Please try again later.</p>";
    }
} else {
    echo "<p class='error'>Invalid request method.</p>";
}
?>