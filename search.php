<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Items</title>
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

<div class="search-container">
    <h2 style="color:#1a73e8; margin-bottom:20px;">🔍 Search Items</h2>

    <form method="GET" class="search-bar">
        <input type="text" name="query" placeholder="Search by item name..."
               value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
        <button type="submit">Search</button>
    </form>

<?php
if (isset($_GET['query']) && $_GET['query'] != '') {
    $query = mysqli_real_escape_string($conn, $_GET['query']);

    echo "<h3 style='color:#e74c3c; margin:20px 0 10px;'>🚨 Lost Items matching '$query':</h3>";
    $sql1 = "SELECT * FROM lost_items WHERE item_name LIKE '%$query%'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            echo "<div class='card' style='display:flex; gap:16px; align-items:flex-start;'>";
            if (!empty($row['image']) && file_exists($row['image'])) {
                echo "<img src='" . $row['image'] . "' style='width:100px; height:100px; 
                      object-fit:cover; border-radius:8px; flex-shrink:0;'>";
            } else {
                echo "<div style='width:100px; height:100px; background:#f0f2f5; 
                      border-radius:8px; display:flex; align-items:center; 
                      justify-content:center; color:#aaa; flex-shrink:0;'>No image</div>";
            }
            echo "<div>";
            echo "<b>" . htmlspecialchars($row['item_name']) . "</b><br>";
            echo "📝 " . htmlspecialchars($row['description']) . "<br>";
            echo "📍 " . htmlspecialchars($row['location']) . "<br>";
            echo "📅 " . $row['date_lost'];
            echo "</div></div>";
        }
    } else {
        echo "<p style='color:#999;'>No lost items found.</p>";
    }

    echo "<h3 style='color:#27ae60; margin:20px 0 10px;'>✅ Found Items matching '$query':</h3>";
    $sql2 = "SELECT * FROM found_items WHERE item_name LIKE '%$query%'";
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_assoc($result2)) {
            echo "<div class='card' style='display:flex; gap:16px; align-items:flex-start;'>";
            if (!empty($row['image']) && file_exists($row['image'])) {
                echo "<img src='" . $row['image'] . "' style='width:100px; height:100px; 
                      object-fit:cover; border-radius:8px; flex-shrink:0;'>";
            } else {
                echo "<div style='width:100px; height:100px; background:#f0f2f5; 
                      border-radius:8px; display:flex; align-items:center; 
                      justify-content:center; color:#aaa; flex-shrink:0;'>No image</div>";
            }
            echo "<div>";
            echo "<b>" . htmlspecialchars($row['item_name']) . "</b><br>";
            echo "📝 " . htmlspecialchars($row['description']) . "<br>";
            echo "📍 " . htmlspecialchars($row['location_found']) . "<br>";
            echo "📅 " . $row['date_found'];
            echo "</div></div>";
        }
    } else {
        echo "<p style='color:#999;'>No found items found.</p>";
    }
}
?>

</div>
</body>
</html>