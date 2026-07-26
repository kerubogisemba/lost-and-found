<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Lost Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="nav">
    <h1>🔍 Lost & Found</h1>
    <div>
        <a href="dashboard.php">Home</a>
        <a href="search.php">Search</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>🚨 Report Lost Item</h2>

    <form action="report_lost_process.php" method="POST" enctype="multipart/form-data">
        <label>Item Name:</label>
        <input type="text" name="item_name" placeholder="e.g. Black iPhone 13" required>

        <label>Description:</label>
        <textarea name="description" rows="3" placeholder="Describe the item..." required></textarea>

        <label>Location Lost:</label>
        <input type="text" name="location" placeholder="e.g. School of Business" required>

        <label>Date Lost:</label>
        <input type="date" name="date_lost" required>

        <label>Upload Image (optional):</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit">Submit Report</button>
    </form>

    <a href="dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>