<?php
session_start();
include('db_config.php'); 


$fullname = $_POST['fullname'];
$age = $_POST['age'];
$province = $_POST['province'];
$district = $_POST['district'];
$bloodgroup = $_POST['bloodgroup'];
$email = $_POST['email'];
$contact = $_POST['contact'];


$sql = "INSERT INTO donors (fullname, age, province, district, bloodgroup, email, contact) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $fullname, $age, $province, $district, $bloodgroup, $email, $contact);

if ($stmt->execute()) {
    $_SESSION['successmsg'] = "Donation recorded successfully!";
} else {
    $_SESSION['errmsg'] = "Failed to record the donation: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: ../donor_list.php");
exit();
?>