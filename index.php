<?php
require_once 'includes/session.php';

if (isLoggedIn()) {
    if (isAdmin()) {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: student/dashboard.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostel Complaint System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <div class="form-box">
        <h1>🏨 Hostel Complaint Management System</h1>
        <p class="subtitle">
            Welcome! Please choose your login type
        </p>

        <a href="student_login.php">
            <button type="button">Student Login</button>
        </a>

        <a href="admin_login.php">
            <button type="button" style="margin-top:10px;">
                Warden Login
            </button>
        </a>

        <p class="link">
            New Student? <a href="register.php">Register here</a>
        </p>
    </div>
</div>

</body>
</html>