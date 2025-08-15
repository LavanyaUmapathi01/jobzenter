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
    $yourName = htmlspecialchars(strip_tags(trim($_POST['your-name'])));
    $yourPhone = htmlspecialchars(strip_tags(trim($_POST['your-phone'])));
    $friendName = htmlspecialchars(strip_tags(trim($_POST['friend-name'])));
    $friendPhone = htmlspecialchars(strip_tags(trim($_POST['friend-phone'])));
    $friendEmail = filter_var($_POST['friend-email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($friendEmail, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address for friend']);
        exit;
    }

    // Initialize PHPMailer
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
        $mail->Subject = "New Friend Referral Submission";
        $mail->Body    = "
            <h2>New Friend Referral Submission</h2>
            <p><strong>Your Name:</strong> {$yourName}</p>
            <p><strong>Your Phone Number:</strong> {$yourPhone}</p>
            <p><strong>Friend's Name:</strong> {$friendName}</p>
            <p><strong>Friend's Phone Number:</strong> {$friendPhone}</p>
            <p><strong>Friend's Email ID:</strong> {$friendEmail}</p>
        ";

        // Send the email
        if ($mail->send()) {
            echo json_encode(['success' => true, 'message' => 'Referral submitted successfully']);
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
