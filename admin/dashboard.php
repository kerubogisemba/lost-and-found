<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../connection.php';

$lost_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM lost_items"))[0];
$found_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM found_items"))[0];
$user_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM users"))[0];

$lost_items = mysqli_query($conn, "SELECT lost_items.*, users.name as reporter FROM lost_items JOIN users ON lost_items.user_id = users.user_id ORDER BY item_id DESC");
$found_items = mysqli_query($conn, "SELECT found_items.*, users.name as reporter FROM found_items JOIN users ON found_items.user_id = users.user_id ORDER BY item_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .stats-row {
            display: flex;
            gap: 20px;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        .stat-card {
            flex: 1;
            min-width: 140px;
            background: white;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        .stat-card h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .stat-card p {
            color: #888;
            font-size: 14px;
            margin: 0;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            margin-bottom: 40px;
        }
        .admin-table th {
            background: #1a73e8;
            color: white;
            padding: 14px 16px;
            text-align: left;
            font-size: 14px;
        }
        .admin-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #f0f2f5;
            font-size: 14px;
            color: #444;
        }
        .admin-table tr:last-child td {
            border-bottom: none;
        }
        .admin-table tr:hover td {
            background: #f8f9ff;
        }
        .btn-delete {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
        }
        .btn-delete:hover {
            background: #c0392b;
        }
        .thumb {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }
        .no-img {
            width: 50px;
            height: 50px;
            background: #f0f2f5;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            color: #aaa;
        }
        .page-content {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }
        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>

<div class="nav">
    <h1>⚙️ Admin Panel</h1>
    <div>
        <a href="../index.php">View Site</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="page-content">

    <div class="stats-row">
        <div class="stat-card">
            <h2 style="color:#e74c3c"><?php echo $lost_count; ?></h2>
            <p>Lost Reports</p>
        </div>
        <div class="stat-card">
            <h2 style="color:#27ae60"><?php echo $found_count; ?></h2>
            <p>Found Reports</p>
        </div>
        <div class="stat-card">
            <h2 style="color:#1a73e8"><?php echo $user_count; ?></h2>
            <p>Registered Users</p>
        </div>
    </div>

    <div class="section-title">🚨 Lost Items</div>
    <table class="admin-table">
        <tr>
            <th>Image</th>
            <th>Item</th>
            <th>Description</th>
            <th>Location</th>
            <th>Date</th>
            <th>Reported By</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($lost_items)): ?>
        <tr>
            <td>
                <?php if (!empty($row['image']) && file_exists('../' . $row['image'])): ?>
                    <img src="../<?php echo $row['image']; ?>" class="thumb">
                <?php else: ?>
                    <div class="no-img">No img</div>
                <?php endif; ?>
            </td>
            <td><b><?php echo htmlspecialchars($row['item_name']); ?></b></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td><?php echo htmlspecialchars($row['location']); ?></td>
            <td><?php echo $row['date_lost']; ?></td>
            <td><?php echo htmlspecialchars($row['reporter']); ?></td>
            <td>
                <form method="POST" action="delete.php">
                    <input type="hidden" name="type" value="lost">
                    <input type="hidden" name="id" value="<?php echo $row['item_id']; ?>">
                    <button class="btn-delete" onclick="return confirm('Delete this item?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="section-title">✅ Found Items</div>
    <table class="admin-table">
        <tr>
            <th>Image</th>
            <th>Item</th>
            <th>Description</th>
            <th>Location</th>
            <th>Date</th>
            <th>Reported By</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($found_items)): ?>
        <tr>
            <td>
            <?php if (!empty($row['image']) && file_exists('../' . $row['image'])): ?>
                <img src="../<?php echo $row['image']; ?>" class="thumb">
            <?php else: ?>
                <div class="no-img">No img</div>
            <?php endif; ?>
            </td>
            <td><b><?php echo htmlspecialchars($row['item_name']); ?></b></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td><?php echo htmlspecialchars($row['location_found']); ?></td>
            <td><?php echo $row['date_found']; ?></td>
            <td><?php echo htmlspecialchars($row['reporter']); ?></td>
            <td>
                <form method="POST" action="delete.php">
                    <input type="hidden" name="type" value="found">
                    <input type="hidden" name="id" value="<?php echo $row['item_id']; ?>">
                    <button class="btn-delete" onclick="return confirm('Delete this item?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>
</body>
</html>