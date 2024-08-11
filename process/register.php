<?php
session_start();
include('db_config.php');

$email = $_POST['email'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

if ($pass1 !== $pass2) {
    echo "<script>
        alert('Passwords do not match!');
        window.location.href='../register.html';
    </script>";
    exit();
}

$hashed_password = password_hash($pass1, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (email, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $hashed_password);

if ($stmt->execute()) {
    echo "<script>
        alert('Registration successful!');
        window.location.href='../login.html';
    </script>";
} else {
    echo "<script>
        alert('Registration failed!');
        window.location.href='../register.html';
    </script>";
}

$stmt->close();
$conn->close();
?>
