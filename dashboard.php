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
    <title>Dashboard - Lost and Found</title>
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

<div class="container" style="max-width:600px; margin-top:40px;">
    <h2>Welcome, <?php echo $_SESSION['name']; ?>! 👋</h2>
    <p style="text-align:center; color:#555; margin-bottom:30px;">What would you like to do today?</p>

    <a href="report_lost.php" class="dash-btn" style="background:linear-gradient(135deg,#e74c3c,#c0392b);">
    🚨 Report Lost Item
</a>
<a href="report_found.php" class="dash-btn" style="background:linear-gradient(135deg,#27ae60,#1e8449);">
    ✅ Report Found Item
</a>
<a href="search.php" class="dash-btn" style="background:linear-gradient(135deg,#1a73e8,#0d47a1);">
    🔍 Search Items
</a>
<a href="ai_match.php" class="dash-btn" style="background:linear-gradient(135deg,#6c35de,#4a1f9e);">
    🤖 AI Smart Match
</a>
</div>

</body>
</html>