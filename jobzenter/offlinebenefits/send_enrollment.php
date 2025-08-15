<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $phone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $state = htmlspecialchars(strip_tags(trim($_POST['state'])));
    $course = htmlspecialchars(strip_tags(trim($_POST['course'])));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address']);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jobzenter24@gmail.com';
        $mail->Password   = 'icts zewc ymqw abrv';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('jobzenter24@gmail.com', 'Jobzenter');
        $mail->addAddress('jobzenter24@gmail.com', 'Jobzenter');

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Enrollment Request from Offline Page";
        $mail->Body    = "
            <h2>New Enrollment Request</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Phone Number:</strong> {$phone}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>State:</strong> {$state}</p>
            <p><strong>Interested Course:</strong> {$course}</p>
        ";

        // Send email
        if ($mail->send()) {
            echo json_encode(['success' => true, 'message' => 'Message sent successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error in sending message']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
