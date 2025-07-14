<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Manually include PHPMailer files
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        die("All fields are required.");
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io'; // Mailtrap SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = '9d8c91823d40e4'; // Replace with Mailtrap username
        $mail->Password = 'd6c79381fe24a6'; // Replace with Mailtrap password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 2525;

        // Email Settings
        $mail->setFrom($email, $name);
        $mail->addAddress('ks8897820@gmail.com', 'Recipient Name'); // Replace with your recipient email
        $mail->Subject = $subject;
        $mail->Body = "Name: $name\nEmail: $email\nMessage: $message";

        if ($mail->send()) {
            echo "<script>alert('Message sent successfully!'); window.location.href='index.html';</script>";
        } else {
            echo "<script>alert('Message could not be sent.'); window.location.href='index.html';</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Mailer Error: " . $mail->ErrorInfo . "'); window.location.href='index.html';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='index.html';</script>";
}
?>
