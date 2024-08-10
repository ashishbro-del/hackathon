<?php
session_start();
include('db_config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

if (isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];
    
    $sql = "DELETE FROM requests WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $request_id, $_SESSION['user_id']);
    
    if ($stmt->execute()) {
        $_SESSION['successmsg'] = "Request deleted successfully!";
    } else {
        $_SESSION['errmsg'] = "Failed to delete request!";
    }

    $stmt->close();
} else {
    $_SESSION['errmsg'] = "Invalid request!";
}

$conn->close();

header("Location: request_list.php");
exit();
?>