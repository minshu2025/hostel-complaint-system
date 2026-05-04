<?php
require_once '../includes/session.php';
require_once '../includes/db.php';
redirectIfNotLoggedIn();

$success = '';

// Complaint submit hone pe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category    = $_POST['category'];
    $priority    = $_POST['priority'];
    $description = trim($_POST['description']);
    $student_id  = $_SESSION['user_id'];

    $sql = "INSERT INTO complaints 
        (student_id, category, priority, description, is_seen) 
        VALUES 
        ('$student_id', '$category', '$priority', '$description', 0)";
    if (mysqli_query($conn, $sql)) {
        $success = "Complaint submitted successfully!";
    }
}

// Is student ki saari complaints
$id = $_SESSION['user_id'];

$count_result = mysqli_query($conn,
    "SELECT COUNT(*) as total FROM complaints WHERE student_id=$id");

$count_row = mysqli_fetch_assoc($count_result);
$total_complaints = $count_row['total'];

$result = mysqli_query($conn,
    "SELECT * FROM complaints WHERE student_id=$id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="navbar">
    <span>🏨 Hostel Complaint System</span>
    <div>
        <span>Welcome, <?php echo $_SESSION['name']; ?>!</span>
        &nbsp;
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="main">

    <!-- Complaint Summary -->
    <div class="card">
        <h3>📊 Complaint Summary</h3>
        <p>
            <strong>Total Complaints Submitted:</strong>
            <?php echo $total_complaints; ?>
        </p>
    </div>

    <!-- Complaint Submit Form -->
    <div class="card">
        <h3>📝 Submit New Complaint</h3>

        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST">
            <select name="category" required>
                <option value="">-- Select Category --</option>
                <option value="Water">Water Problem</option>
                <option value="Electricity">Electricity Problem</option>
                <option value="WiFi">WiFi Problem</option>
                <option value="Room">Room Problem</option>
                <option value="Cleanliness">Cleanliness</option>
                <option value="Other">Other</option>
            </select>

            <select name="priority" required>
                <option value="">-- Select Priority --</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>

            <textarea name="description" rows="4"
                placeholder="Describe your complaint..." required></textarea>

            <button type="submit">Submit Complaint</button>
        </form>
    </div>

    <!-- Complaints List -->
    <div class="card">
        <h3>📋 My Complaints</h3>

        <table>
            <tr>
                <th>Category</th>
                <th>Priority</th>
                <th>Description</th>
                <th>Status</th>
                <th>Warden Remark</th>
                <th>Date</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['priority']; ?></td>
                <td><?php echo $row['description']; ?></td>

                <td>
                    <span class="badge <?php
                        echo $row['status'] === 'Pending' ? 'pending' :
                            ($row['status'] === 'In Progress' ? 'progress' : 'resolved');
                    ?>">
                        <?php echo $row['status']; ?>
                    </span>
                </td>

                <td>
                    <?php
                        echo !empty($row['remarks'])
    ? $row['remarks']
    : 'No update yet';
                    ?>
                </td>

                <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
            </tr>
            <?php endwhile; ?>

        </table>
    </div>

</div>

</body>
</html>