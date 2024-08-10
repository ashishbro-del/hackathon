<?php
session_start();
include('process/db_config.php');

// Check if the user is logged in


// Delete request if 'delete' parameter is set in the query string
if (isset($_GET['delete'])) {
    $request_id = $_GET['delete'];
    $delete_sql = "DELETE FROM requests WHERE id = ? AND user_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);

    // Bind parameters and execute the delete statement
    $delete_stmt->bind_param("ii", $request_id, $user_id);
    if ($delete_stmt->execute()) {
        $_SESSION['successmsg'] = "Request deleted successfully!";
    } else {
        $_SESSION['errmsg'] = "Failed to delete request!";
    }
    $delete_stmt->close();
    header("Location: request_list.php");
    exit();
}

// Fetch requests for the logged-in user
$sql = "SELECT id, blood_group, province, city, email FROM requests WHERE user_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the user_id parameter and execute the query
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $_SESSION['errmsg'] = "Failed to prepare the request query!";
    header("Location: request_list.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
        .table {
            margin-top: 20px;
        }
        .success-msg {
            color: green;
            margin-top: 20px;
        }
        .error-msg {
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Your Blood Requests</h1>
    <?php if (isset($_SESSION['successmsg'])) { ?>
        <div class="success-msg">
            <?php echo $_SESSION['successmsg']; unset($_SESSION['successmsg']); ?>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION['errmsg'])) { ?>
        <div class="error-msg">
            <?php echo $_SESSION['errmsg']; unset($_SESSION['errmsg']); ?>
        </div>
    <?php } ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Blood Group</th>
                <th>Province</th>
                <th>City</th>
                <th>Email</th>
                <th>doctor's recommendation</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                <td><?php echo htmlspecialchars($row['province']); ?></td>
                <td><?php echo htmlspecialchars($row['city']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['doctors recommEndation']); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <a href="request.html" class="btn btn-primary">Add New Request</a>
</div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
