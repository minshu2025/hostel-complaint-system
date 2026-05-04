<?php
require_once '../includes/session.php';
require_once '../includes/db.php';

redirectIfNotLoggedIn();

if (!isAdmin()) {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['id']) && isset($_POST['status'])) {
    $id      = $_GET['id'];
    $status  = $_POST['status'];
    $remarks = trim($_POST['remarks']);

    $sql = "UPDATE complaints 
            SET status='$status',
                remarks='$remarks'
            WHERE id='$id'";

    mysqli_query($conn, $sql);

    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM complaints WHERE id='$id'");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Complaint Status</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="navbar">
    <span>🏨 Update Complaint Status</span>
    <a href="dashboard.php">← Back</a>
</div>

<div class="main">
    <div class="card">
        <h3>Update Complaint</h3>

        <p><strong>Category:</strong> <?php echo $row['category']; ?></p>
        <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
        <br>

        <form method="POST">

            <label><strong>Update Status</strong></label>
            <select name="status" required>
                <option value="Pending"
                    <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>
                    Pending
                </option>

                <option value="In Progress"
                    <?php if ($row['status'] == 'In Progress') echo 'selected'; ?>>
                    In Progress
                </option>

                <option value="Resolved"
                    <?php if ($row['status'] == 'Resolved') echo 'selected'; ?>>
                    Resolved
                </option>
            </select>

            <br><br>

            <label><strong>Warden Remarks</strong></label>
            <textarea
                name="remarks"
                rows="5"
                placeholder="Write remarks like: Electrician informed, issue will be solved tomorrow..."
            ><?php echo isset($row['remarks']) ? $row['remarks'] : ''; ?></textarea>

            <button type="submit">
                Update Complaint
            </button>

        </form>
    </div>
</div>

</body>
</html>