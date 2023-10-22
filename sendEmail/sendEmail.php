<?php

// Include required PHPMailer files
require './phpMailer/PHPMailer.php';
require './phpMailer/SMTP.php';
require './phpMailer/Exception.php';
// require 'vendor/autoload.php';

// Define namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Function to send email
 *
 * @param string $sendersEmail    Sender's email address
 * @param string $sendersPassword Sender's email password
 * @param string $recieversEmail  Recipient's email address
 * @param string $subject         Email subject
 * @param string $body            Email body
 *
 * @return bool                   True on success, false on failure
 */
function sendEmail($sendersEmail, $sendersPassword, $recieversEmail, $subject, $body)
{
    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $sendersEmail; // SMTP username
        $mail->Password = $sendersPassword; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom($sendersEmail, $subject);
        $mail->addAddress($recieversEmail); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return true; // Email sent successfully

    } catch (Exception $e) {
        return false; // Email sending failed
    }
}