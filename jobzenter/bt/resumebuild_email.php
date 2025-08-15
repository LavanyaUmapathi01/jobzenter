<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader if using Composer, or require the PHPMailer files directly
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['rname']) ? $_POST['rname'] : '';
    $email = isset($_POST['remail']) ? $_POST['remail'] : '';
    $phone = isset($_POST['rphone']) ? $_POST['rphone'] : '';
    $terms = isset($_POST['rterms']) ? $_POST['rterms'] : '';

    // Validate that required fields are not empty
    if (empty($name) || empty($email) || empty($phone) || empty($terms)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';                    
        $mail->SMTPAuth   = true;                                 
        $mail->Username   = 'jobzenter24@gmail.com';  // Your Gmail address             
        $mail->Password   = 'icts zewc ymqw abrv';   // Your Gmail app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       
        $mail->Port       = 587;                                  

        // Recipients
        $mail->setFrom('jobzenter24@gmail.com', 'Jobzenter');     
        $mail->addAddress('jobzenter24@gmail.com', 'Jobzenter');  

        // Content
        $mail->isHTML(true);                                      
        $mail->Subject = "New Registration on Free Resume building";
        $mail->Body    = "
            <h2>Details of the Resume building registered candidate</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Agreed to Terms:</strong> " . ($terms ? 'Yes' : 'No') . "</p>
        ";

        // Send the email
        if ($mail->send()) {
            echo json_encode(['success' => true, 'message' => 'Registration details sent successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to send registration details']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
