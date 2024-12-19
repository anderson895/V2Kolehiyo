<?php
// Include database connection
require 'includes/db.php';

$error = "";

// Start session at the beginning
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (!empty($user_name) && !empty($password)) {
        // Simple query without prepared statement (Not secure for production)
        $query = "SELECT user_name, password FROM users WHERE user_name = '$user_name'";
        $result = $dsn->query($query);
        $user = $result->fetch_assoc();

        // Check if user exists and verify password
        if ($user && $password === $user['password']) {  // Plain text comparison
            $_SESSION['username'] = $user['user_name'];  // Store username in session
            header("Location: pages/portfolio.php");
            exit;
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login</title>
</head>
<body>
<div class="login-container">
    <h1>Login</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
