<?php
// Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true); // Enable exceptions for error handling

    try {
        // Server settings
        $mail->isSMTP();                                      // Send using SMTP
        $mail->Host = 'smtp.gmail.com';                       // Gmail SMTP server
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'your_email@gmail.com';             // Your Gmail address
        $mail->Password = 'your_app_password';                // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption
        $mail->Port = 587;                                    // SMTP port

        // Recipients
        $mail->setFrom($email, 'Website Contact Form');       // Sender email
        $mail->addAddress('your_email@gmail.com');            // Destination email

        // Content
        $mail->isHTML(true);                                  // Use HTML
        $mail->Subject = 'New Message from Contact Form';
        $mail->Body = nl2br("Email: $email\n\nMessage:\n$message");

        // Send email
        $mail->send();
        echo "<h1>Message sent successfully!</h1>";
    } catch (Exception $e) {
        echo "<h1>Message could not be sent. Error: {$mail->ErrorInfo}</h1>";
    }
}
?>
