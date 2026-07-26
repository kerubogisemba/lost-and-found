<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$id = $_POST['id'];
$type = $_POST['type'];

if ($type === 'lost') {
    mysqli_query($conn, "DELETE FROM lost_items WHERE item_id='$id'");
} else {
    mysqli_query($conn, "DELETE FROM found_items WHERE item_id='$id'");
}

header("Location: dashboard.php");
exit();
?>