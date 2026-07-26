<!DOCTYPE html>
<html>
<head>
    <title>Register - Lost and Found</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>🔍 Create Account</h2>

    <form action="register_process.php" method="POST">
        <label>Name:</label>
        <input type="text" name="name" placeholder="Enter your full name" required>

        <label>Email:</label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <label>Password:</label>
        <input type="password" name="password" placeholder="Create a password" required>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

</body>
</html>