<!DOCTYPE html>
<html>
<head>
    <title>Login - Lost and Found</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>🔍 Lost & Found</h2>

    <form action="login_process.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter your password" required>

        <button type="submit">Login</button>
    </form>

    <p>No account? <a href="register.php">Register here</a></p>
</div>

</body>
</html>