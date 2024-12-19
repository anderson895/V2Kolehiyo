<?php
// Include database connection
require '../includes/db.php';

$error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (!empty($user_name) && !empty($password)) {
        // Simple query without prepared statement (Not secure for production)
        $query = "SELECT admin_username, admin_password FROM admin WHERE admin_username = '$user_name'";
        $result = $dsn->query($query);
        $user = $result->fetch_assoc();

        // Check if user exists and verify password
        if ($user && $password === $user['admin_password']) {  // Plain text comparison
            // Start session at the beginning
            session_start();

            $_SESSION['username'] = $user['admin_username'];  // Store username in session
            header("Location:   dashboard.php");
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
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <!-- Logo -->
            
            <!-- Bootstrap Icon -->
            <h3 class="card-title text-center mb-4">
                <i class="bi bi-shield-lock"></i> Administrator Login
            </h3>
            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required placeholder="Enter your username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <?php if ($error): ?>
                    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>