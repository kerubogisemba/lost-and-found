<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$item_name = $_POST['item_name'];
$description = $_POST['description'];
$location = $_POST['location'];
$date_lost = $_POST['date_lost'];
$status = "lost";
$image = "";

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $uploads_dir = "uploads/";
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }
    $filename = time() . "_" . basename($_FILES['image']['name']);
    $target = $uploads_dir . $filename;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $image = $target;
    }
}

$sql = "INSERT INTO lost_items (user_id, item_name, description, location, date_lost, status, image) 
        VALUES ('$user_id', '$item_name', '$description', '$location', '$date_lost', '$status', '$image')";

if (mysqli_query($conn, $sql)) {
    header("Location: dashboard.php?success=lost");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>