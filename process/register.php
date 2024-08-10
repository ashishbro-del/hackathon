<?php
session_start();
include('db_config.php');


$email = $_POST['email'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];


if ($pass1 !== $pass2) {
    $_SESSION['errmsg'] = "Passwords do not match!";
    header("Location: ../register.html");
    exit();
}

$hashed_password = password_hash($pass1, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (email, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $hashed_password);

if ($stmt->execute()) {
    $_SESSION['successmsg'] = "Registration successful!";
    header("Location: ../login.html");
} else {
    $_SESSION['errmsg'] = "Registration failed!";
    header("Location: ../register.html");
}

$stmt->close();
$conn->close();
?>