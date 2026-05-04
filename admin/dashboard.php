<?php
require_once '../includes/session.php';
require_once '../includes/db.php';

redirectIfNotLoggedIn();

if (!isAdmin()) {
    header("Location: ../index.php");
    exit();
}

// ✅ Notification count (FIXED: always defined for admin)
$notification_query = mysqli_query($conn, 
    "SELECT COUNT(*) as total_new 
     FROM complaints 
     WHERE is_seen = 0");

$notification_row = mysqli_fetch_assoc($notification_query);
$total_new = $notification_row['total_new'];

// All complaints data
$result = mysqli_query($conn, "
    SELECT complaints.*, 
           users.name,
           users.contact,
           users.course,
           users.year,
           users.branch,
           users.room_no
    FROM complaints
    JOIN users ON complaints.student_id = users.id
    ORDER BY created_at DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="navbar">
    <span>🏨 Hostel Complaint System - Admin</span>
    <div>
        <span>Welcome, <?php echo $_SESSION['name']; ?>!</span>
        &nbsp;
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="main">

    <!-- Notifications -->
    <div class="card">
        <h3>🔔 Notifications</h3>
        <p>
            <strong>New Complaints:</strong>
            <?php echo $total_new; ?>
        </p>
    </div>

    <!-- All Complaints -->
    <div class="card">
        <h3>📋 All Complaints</h3>

        <table>
            <tr>
                <th>Student</th>
                <th>Contact</th>
                <th>Course</th>
                <th>Year</th>
                <th>Branch</th>
                <th>Room No</th>
                <th>Category</th>
                <th>Priority</th>
                <th>Description</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo $row['year']; ?></td>
                <td><?php echo $row['branch']; ?></td>
                <td><?php echo $row['room_no']; ?></td>
                <td><?php echo $row['category']; ?></td>

                <td>
                    <span class="badge <?php
                        echo $row['priority'] === 'Low' ? 'resolved' :
                            ($row['priority'] === 'Medium' ? 'pending' : 'progress');
                    ?>">
                        <?php echo $row['priority']; ?>
                    </span>
                </td>

                <td><?php echo $row['description']; ?></td>

                <td>
                    <span class="badge <?php
                        echo $row['status'] === 'Pending' ? 'pending' :
                            ($row['status'] === 'In Progress' ? 'progress' : 'resolved');
                    ?>">
                        <?php echo $row['status']; ?>
                    </span>
                </td>

                <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>

                <td>
                    <a href="manage.php?id=<?php echo $row['id']; ?>">Update</a>
                    |
                    <a href="delete.php?id=<?php echo $row['id']; ?>"
                       onclick="return confirm('Are you sure?')">
                       Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>

        </table>
    </div>

</div>

</body>
</html>