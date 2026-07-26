<!DOCTYPE html>
<html>
<head>
    <title>Lost & Found System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px 20px;
        }

        .hero h1 {
            font-size: 48px;
            color: white;
            margin-bottom: 16px;
            font-weight: 700;
        }

        .hero p {
            font-size: 20px;
            color: rgba(255,255,255,0.85);
            max-width: 500px;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn-white {
            background: white;
            color: #1a73e8;
            padding: 14px 32px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        }

        .btn-outline {
            background: transparent;
            color: white;
            padding: 14px 32px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            border: 2px solid rgba(255,255,255,0.7);
            transition: transform 0.2s, background 0.2s;
        }

        .btn-outline:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-2px);
        }

        .features {
            display: flex;
            gap: 24px;
            margin-top: 60px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .feature-card {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 12px;
            padding: 24px;
            width: 180px;
            color: white;
        }

        .feature-card .icon {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .feature-card h3 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .feature-card p {
            font-size: 13px;
            color: rgba(255,255,255,0.75);
            margin: 0;
        }

        .stats {
            display: flex;
            gap: 40px;
            margin-top: 50px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .stat {
            text-align: center;
            color: white;
        }

        .stat h2 {
            font-size: 36px;
            font-weight: 700;
            color: white;
            margin-bottom: 4px;
        }

        .stat p {
            font-size: 14px;
            color: rgba(255,255,255,0.75);
            margin: 0;
        }
    </style>
</head>
<body>

<div class="hero">
    <div style="font-size:64px; margin-bottom:16px;">🔍</div>
    <h1>Lost & Found System</h1>
    <p>Helping our community reunite people with their lost belongings. Fast, simple, and smart.</p>

    <div class="hero-buttons">
        <a href="register.php" class="btn-white">Get Started</a>
        <a href="login.php" class="btn-outline">Login</a>
    </div>

    <div class="stats">
        <?php
        include 'connection.php';
        $lost_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM lost_items"))[0];
        $found_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM found_items"))[0];
        $user_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM users"))[0];
        ?>
        <div class="stat">
            <h2><?php echo $lost_count; ?></h2>
            <p>Lost Reports</p>
        </div>
        <div class="stat">
            <h2><?php echo $found_count; ?></h2>
            <p>Found Reports</p>
        </div>
        <div class="stat">
            <h2><?php echo $user_count; ?></h2>
            <p>Users</p>
        </div>
    </div>

    <div class="features">
        <div class="feature-card">
            <div class="icon">📋</div>
            <h3>Report Items</h3>
            <p>Quickly report lost or found items with photos</p>
        </div>
        <div class="feature-card">
            <div class="icon">🔍</div>
            <h3>Smart Search</h3>
            <p>Search across all reported items instantly</p>
        </div>
        <div class="feature-card">
            <div class="icon">🤖</div>
            <h3>AI Matching</h3>
            <p>Claude AI finds possible matches for you</p>
        </div>
        <div class="feature-card">
            <div class="icon">🔒</div>
            <h3>Secure</h3>
            <p>Your data is safe and encrypted</p>
        </div>
    </div>
</div>

</body>
</html>