<?php
require_once 'includes/session.php';

if (isLoggedIn()) {
    header("Location: index.php");
    exit();
}

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'includes/db.php';

    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role     = trim($_POST['role']);

    // 👇 Student fields (optional)
    $contact  = $_POST['contact'] ?? '';
    $course   = $_POST['course'] ?? '';
    $year     = $_POST['year'] ?? '';
    $branch   = $_POST['branch'] ?? '';
    $room_no  = $_POST['room_no'] ?? '';

    // 👉 Agar admin hai to ye sab blank
    if ($role === 'admin') {
        $contact = $course = $year = $branch = $room_no = '';
    }

    // Email check
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        $error = "Email already registered!";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users 
        (name, email, password, contact, course, year, branch, room_no, role)
        VALUES
        ('$name', '$email', '$hashed', '$contact', '$course', '$year', '$branch', '$room_no', '$role')";

        if (mysqli_query($conn, $sql)) {
            $success = "Account created! You can now login.";
        } else {
            $error = "Something went wrong. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Hostel Complaint System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <div class="form-box">
        <h2>🏨 Create Account</h2>
        <p class="subtitle">Register as Student or Warden</p>

        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST">

            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>

            <!-- 👇 Role select -->
            <select name="role" id="role" onchange="toggleFields()" required>
                <option value="student">Student</option>
                <option value="admin">Warden (Admin)</option>
            </select>

            <!-- 👇 Student Fields -->
            <div id="studentFields">
                <input type="text" name="contact" placeholder="Contact Number">
                <input type="text" name="course" placeholder="Course (BCA/BBA/etc)">
                <input type="text" name="year" placeholder="Year (1st/2nd/3rd)">
                <input type="text" name="branch" placeholder="Branch">
                <input type="text" name="room_no" placeholder="Room Number">
            </div>

            <button type="submit">Register</button>
        </form>

        <p class="link">
            Already have account?
            <a href="index.php">Login here</a>
        </p>
    </div>
</div>

<!-- 👇 JS for toggle -->
<script>
function toggleFields() {
    var role = document.getElementById("role").value;
    var fields = document.getElementById("studentFields");

    if (role === "admin") {
        fields.style.display = "none";
    } else {
        fields.style.display = "block";
    }
}
</script>

</body>
</html>