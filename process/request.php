<?php
session_start();
include('db_config.php'); 

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You are not logged in. Please log in first.'); window.location.href='../request_list.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$blood_group = $_POST['blood-group'];
$province = $_POST['province'];
$city = $_POST['city'];
$email = $_POST['email'];

// Handle document upload



$sql = "INSERT INTO blood_requests (blood_group, province, city, email) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param('ssss', $blood_group, $province, $city, $email);

if ($stmt->execute()) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();                                         
        $mail->Host       = 'smtp.gmail.com';                  
        $mail->SMTPAuth   = true;                             
        $mail->Username   = 'alamichhane961@gmail.com';           
        $mail->Password   = 'yydr qltk bsbb pwbj';                     
        $mail->SMTPSecure = 'ssl';    
        $mail->Port       = 465;  
        $mail->SMTPDebug = 0; 

        $mail->setFrom('alamichhane961@gmail.com', 'Ashish Lamichhane');
        $mail->addAddress($_POST['email']);                               

        $mail->isHTML(true);                                    
        $mail->Subject = 'Blood Request Received';
        $mail->Body    = 'Dear User,<br><br>Your blood request has been received. Thank you for your submission.<br><br>Best regards,<br>Blood Donation Team';
        $mail->AltBody = 'Dear User,\n\nYour blood request has been received. Thank you for your submission.\n\nBest regards,\nBlood Donation Team';

        $mail->send();
        echo "<script>alert('Request submitted successfully! A confirmation email has been sent.'); window.location.href='../index.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Request submitted but failed to send email. Error: " . $mail->ErrorInfo . "'); window.location.href='../index.html';</script>";
    }
} else {
    echo "<script>alert('Request submission failed: " . htmlspecialchars($stmt->error) . "'); window.location.href='../index.html';</script>";
}

$stmt->close();
$conn->close();

exit();
?>
