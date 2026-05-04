<?php
require_once '../includes/session.php';
require_once '../includes/db.php';

redirectIfNotLoggedIn();

if (!isAdmin()) {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM complaints WHERE id='$id'");
}

header("Location: dashboard.php");
exit();
?>