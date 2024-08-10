<?php
session_start();
include('process/db_config.php'); // Adjust path if needed

// Fetching all donors from the database
$sql = "SELECT id, fullname, age, province, district, bloodgroup, email, contact FROM donors ORDER BY fullname ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor List</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .container {
                width: 95%;
            }

            table, th, td {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }
        }

        /* Success and Error Message Styling */
        .success {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .error {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Add Donor Button Styling */
        .add-donor-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .add-donor-btn:hover {
            background-color: #218838;
        }

        /* Delete Button Styling */
        .delete-btn {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Donor List</h1>

        <?php if (isset($_SESSION['successmsg'])): ?>
            <p class="success"><?php echo $_SESSION['successmsg']; unset($_SESSION['successmsg']); ?></p>
        <?php elseif (isset($_SESSION['errmsg'])): ?>
            <p class="error"><?php echo $_SESSION['errmsg']; unset($_SESSION['errmsg']); ?></p>
        <?php endif; ?>

        <a href="donate.html" class="add-donor-btn">Add Donor</a>

        <table>
            <tr>
                <th>Full Name</th>
                <th>Age</th>
                <th>Province</th>
                <th>District</th>
                <th>Blood Group</th>
                <th>Email</th>
                <th>Contact</th>
              
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                        <td><?php echo htmlspecialchars($row['province']); ?></td>
                        <td><?php echo htmlspecialchars($row['district']); ?></td>
                        <td><?php echo htmlspecialchars($row['bloodgroup']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact']); ?></td>
                    
                           
            
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No donors found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>