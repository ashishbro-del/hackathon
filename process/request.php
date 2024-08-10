<?php
session_start();
include('../db_config.php'); // Ensure this path is correct based on your directory structure

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['user_id'])) {
    header("Location: ../request_list.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$blood_group = $_POST['blood-group'];
$province = $_POST['province'];
$city = $_POST['city'];
$email = $_POST['email'];

// Handle file upload
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["recommendation-file"]["name"]);
$file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Validate file type
$allowed_types = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
if (!in_array($file_type, $allowed_types)) {
    $_SESSION['errmsg'] = "Only PDF, DOC, DOCX, JPG, JPEG, and PNG files are allowed.";
    header("Location: ../request.html");
    exit();
}

// Move the file to the target directory
if (!move_uploaded_file($_FILES["recommendation-file"]["tmp_name"], $target_file)) {
    $_SESSION['errmsg'] = "Sorry, there was an error uploading your file.";
    header("Location: ../request.html");
    exit();
}

// Insert the data into the database
$sql = "INSERT INTO requests_blood (user_id, blood_group, province, city, email, recommendation_file) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("isssss", $user_id, $blood_group, $province, $city, $email, $target_file);

if ($stmt->execute()) {
    $_SESSION['successmsg'] = "Request submitted successfully!";

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();                                         
        $mail->Host       = 'smtp.example.com';                  
        $mail->SMTPAuth   = true;                             
        $mail->Username   = 'your_email@example.com';           
        $mail->Password   = 'your_password';                     
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    
        $mail->Port       = 587;                                 

        $mail->setFrom('your_email@example.com', 'Blood Donation');
        $mail->addAddress($email);                               

        $mail->isHTML(true);                                    
        $mail->Subject = 'Blood Request Received';
        $mail->Body    = 'Dear User,<br><br>Your blood request has been received. Thank you for your submission.<br><br>Best regards,<br>Blood Donation Team';
        $mail->AltBody = 'Dear User,\n\nYour blood request has been received. Thank you for your submission.\n\nBest regards,\nBlood Donation Team';

        $mail->send();
    } catch (Exception $e) {
        $_SESSION['errmsg'] = "Request submitted but failed to send email. Error: " . $mail->ErrorInfo;
    }
} else {
    $_SESSION['errmsg'] = "Request submission failed: " . htmlspecialchars($stmt->error);
}

$stmt->close();
$conn->close();

header("Location: ../request.html");
exit();
?>
