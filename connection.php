<?php
$host = getenv('DB_HOST') ?: 'reseau.proxy.rlwy.net';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: 'jRLMkLYNVQZQsjLzJScVrXTjBFtHGdob';
$database = getenv('DB_NAME') ?: 'railway';
$port = getenv('DB_PORT') ?: 29877;

$conn = mysqli_connect($host, $user, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>