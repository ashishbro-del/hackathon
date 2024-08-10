<?php
session_start();
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donor_id = $_POST['id'];

    $sql = "DELETE FROM donors WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $donor_id);

        
        if ($stmt->execute()) {
            $_SESSION['successmsg'] = "Donor deleted successfully!";
        } else {
            $_SESSION['errmsg'] = "Error deleting donor: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['errmsg'] = "Error preparing statement: " . $conn->error;
    }

    $conn->close();


    header("Location: ../donor_list.php");
    exit();
} else {
    header("Location: ../donor_list.php");
    exit();
}
?>