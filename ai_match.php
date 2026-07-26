<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$api_key = "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"; // 👈 Paste your key here

function askClaude($api_key, $prompt) {
    $data = [
        "model" => "claude-sonnet-4-20250514",
        "max_tokens" => 1024,
        "messages" => [
            ["role" => "user", "content" => $prompt]
        ]
    ];

    $ch = curl_init("https://api.anthropic.com/v1/messages");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "x-api-key: $api_key",
        "anthropic-version: 2023-06-01"
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $response = curl_exec($ch);
    $curl_error = curl_error($ch);
    curl_close($ch);

    if ($curl_error) {
        return "CURL Error: " . $curl_error;
    }

    $result = json_decode($response, true);

    if (isset($result['error'])) {
        return "API Error: " . $result['error']['message'];
    }

    return $result['content'][0]['text'] ?? "Raw response: " . $response;
}

// Get all lost items
$lost_result = mysqli_query($conn, "SELECT * FROM lost_items");
$lost_items = [];
while ($row = mysqli_fetch_assoc($lost_result)) {
    $lost_items[] = $row;
}

// Get all found items
$found_result = mysqli_query($conn, "SELECT * FROM found_items");
$found_items = [];
while ($row = mysqli_fetch_assoc($found_result)) {
    $found_items[] = $row;
}

// Build prompt for Claude
$lost_list = "";
foreach ($lost_items as $item) {
    $lost_list .= "- ID {$item['item_id']}: {$item['item_name']} | {$item['description']} | Location: {$item['location']} | Date: {$item['date_lost']}\n";
}

$found_list = "";
foreach ($found_items as $item) {
    $found_list .= "- ID {$item['item_id']}: {$item['item_name']} | {$item['description']} | Location: {$item['location_found']} | Date: {$item['date_found']}\n";
}

$prompt = "You are an AI assistant for a Lost and Found system at a university.

Here are the LOST items:
$lost_list

Here are the FOUND items:
$found_list

Please do two things:
1. Identify any possible matches between lost and found items. Explain why they might match based on name, description, location, and date.
2. For each lost item, briefly describe what it likely looks like visually so the owner can recognize it.

Be friendly, clear and concise.";

$ai_response = askClaude($api_key, $prompt);
?>

<!DOCTYPE html>
<html>
<head>
    <title>AI Match - Lost and Found</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .ai-box {
            background: linear-gradient(135deg, #1a73e8, #0d47a1);
            color: white;
            padding: 24px;
            border-radius: 12px;
            margin-top: 20px;
            line-height: 1.8;
            white-space: pre-wrap;
        }
        .ai-label {
            font-size: 13px;
            background: rgba(255,255,255,0.2);
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            margin-bottom: 12px;
        }
        .loading {
            text-align: center;
            color: #1a73e8;
            font-size: 18px;
            margin-top: 40px;
        }
    </style>
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
    <h2 style="color:#1a73e8; margin-bottom:20px;">🤖 AI Smart Match</h2>
    <p style="color:#555; margin-bottom:20px;">
        Our AI analyzes all lost and found items and finds possible matches for you!
    </p>

    <div class="ai-box">
        <div class="ai-label">🤖 Claude AI Analysis</div><br>
        <?php echo nl2br(htmlspecialchars($ai_response)); ?>
    </div>

    <a href="dashboard.php" style="margin-top:20px;">← Back to Dashboard</a>
</div>

</body>
</html>