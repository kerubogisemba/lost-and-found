<?php
session_start();

$admin_user = "admin";
$admin_pass = "admin123";

if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) {
    $_SESSION['admin'] = true;
    header("Location: dashboard.php");
    exit();
} else {
    echo "Wrong credentials. <a href='login.php'>Try again</a>";
}
?>