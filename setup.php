<?php
$host = "reseau.proxy.rlwy.net";
$user = "root";
$password = "jRLMkLYNVQZQsjLzJScVrXTjBFtHGdob";
$database = "railway";
$port = 29877;

$conn = mysqli_connect($host, $user, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql1 = "CREATE TABLE IF NOT EXISTS users (user_id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), email VARCHAR(100), password VARCHAR(255), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

$sql2 = "CREATE TABLE IF NOT EXISTS lost_items (item_id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, item_name VARCHAR(150), description TEXT, location VARCHAR(150), date_lost DATE, status VARCHAR(50) DEFAULT 'open', image VARCHAR(255), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

$sql3 = "CREATE TABLE IF NOT EXISTS found_items (item_id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, item_name VARCHAR(150), description TEXT, location_found VARCHAR(150), date_found DATE, status VARCHAR(50) DEFAULT 'open', image VARCHAR(255), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

mysqli_query($conn, $sql1) ? print("✅ Users table created!<br>") : print("❌ " . mysqli_error($conn) . "<br>");
mysqli_query($conn, $sql2) ? print("✅ Lost items table created!<br>") : print("❌ " . mysqli_error($conn) . "<br>");
mysqli_query($conn, $sql3) ? print("✅ Found items table created!<br>") : print("❌ " . mysqli_error($conn) . "<br>");

echo "<br>Done! <a href='index.php'>Go to site</a>";
?>
