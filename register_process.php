<?php
include 'connection.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "Registration successful! <a href='login.php'>Login here</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>