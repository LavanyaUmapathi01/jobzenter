<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Require PHPMailer library files
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form data
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
    $pdfFileName = htmlspecialchars(strip_tags(trim($_POST['pdfFileName'])));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address']);
        exit;
    }

    // Determine the service based on the PDF file name
    $service = '';
    switch ($pdfFileName) {
        case 'Software Testing.pdf':
            $service = 'Software Testing';
            break;
        case 'full stack development.pdf':
            $service = 'Full Stack Development';
            break;
        case 'POWER BI.pdf':
            $service = 'Business Intelligence'; 
            break;
        case 'AWS DEVOPS.pdf':
            $service = 'AWS Devops';
            break;
        case 'advanced_courses.pdf':
            $service = 'Advanced Courses';
            break;
        case 'one_to_one_training.pdf':
            $service = 'One to One Training';
            break;
        default:
            $service = 'Unknown Service';
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
        $mail->Subject = "$name has downloaded the $service brochure";
        $mail->Body    = "
            <h2>New Brochure download</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Service Requested:</strong> {$service}</p>
        ";

        // Send the email
        if($mail->send()) {
            echo json_encode(['success' => true, 'pdfFileName' => $pdfFileName]);
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
