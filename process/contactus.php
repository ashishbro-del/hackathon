<?php
session_start();
include('db_config.php');



$full_name = $_POST['full_name'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$message = $_POST['message'];

$sql = "INSERT INTO contact_us (full_name, phone_number, email, message)
        VALUES ('$full_name', '$phone_number', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Message sent successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>