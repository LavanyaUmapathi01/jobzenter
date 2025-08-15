<?php
// Enable error reporting for debugging
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
    $friend_name = htmlspecialchars(strip_tags(trim($_POST['friend_name'])));
    $friend_phone = htmlspecialchars(strip_tags(trim($_POST['friend_phone'])));

    // Validate the phone number
    if (!preg_match('/^[0-9]{10}$/', $friend_phone)) {
        echo json_encode(['success' => false, 'message' => 'Invalid phone number']);
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
        $mail->Password   = 'icts zewc ymqw abrv';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('jobzenter24@gmail.com', 'Jobzenter');
        $mail->addAddress('jobzenter24@gmail.com', 'Jobzenter');

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Refer and Earn Submission";
        $mail->Body    = "
            <h2>Refer and Earn Submission</h2>
            <p><strong>Friend's Name:</strong> {$friend_name}</p>
            <p><strong>Friend's Phone Number:</strong> {$friend_phone}</p>
        ";

        // Send the email
        if ($mail->send()) {
            echo json_encode(['success' => true, 'message' => 'Referral sent successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error in sending referral']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
