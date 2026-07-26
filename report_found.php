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
    <title>Report Found Item</title>
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
    <h2>✅ Report Found Item</h2>

    <form action="report_found_process.php" method="POST" enctype="multipart/form-data">
        <label>Item Name:</label>
        <input type="text" name="item_name" placeholder="e.g. Water Bottle" required>

        <label>Description:</label>
        <textarea name="description" rows="3" placeholder="Describe the item..." required></textarea>

        <label>Location Found:</label>
        <input type="text" name="location_found" placeholder="e.g. School Gate" required>

        <label>Date Found:</label>
        <input type="date" name="date_found" required>

        <label>Upload Image (optional):</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit" style="background:#27ae60;">Submit Report</button>
    </form>

    <a href="dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>