<?php
session_start();
include('db_config.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../request.html");
    } else {
        $_SESSION['errmsg'] = "Invalid password!";
        header("Location: ../login.html");
    }
} else {
    $_SESSION['errmsg'] = "User not found!";
    header("Location: ../login.html");
}

$stmt->close();
$conn->close();
?>