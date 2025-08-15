<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Require PHPMailer library files
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
    $state = htmlspecialchars(strip_tags(trim($_POST['state'])));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address']);
        exit;
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jobzenter24@gmail.com';
        $mail->Password   = 'icts zewc ymqw abrv'; // Use your actual SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('jobzenter24@gmail.com', 'Jobzenter');
        $mail->addAddress('jobzenter24@gmail.com', 'Jobzenter');

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Quiz Submission";
        $mail->Body    = "
            <h2>New Quiz Form Submission</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>State:</strong> {$state}</p>
        ";

        // Send the email
        if ($mail->send()) {
            echo json_encode(['success' => true, 'message' => 'Form submitted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error in sending email']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
