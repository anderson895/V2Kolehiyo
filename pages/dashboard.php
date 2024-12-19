<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Dashboard</title>
</head>
<body>
<div class="dashboard">
    <h1>Welcome, <?= htmlspecialchars($username); ?>!</h1>

    <div class="profile-container">
        <div class="profile-image"></div>
        <div class="profile-info">
            <h2>John Doe</h2>
            <p>This is your portfolio page. You can customize your profile picture, about section, projects, etc.</p>
            <button class="profile-button" onclick="window.location.href='edit_profile.php'">Edit Profile</button>
        </div>
    </div>

    <div class="card">
        <h3>About Me</h3>
        <p><a href="about.php">Learn more about me</a></p>
    </div>
    <div class="card">
        <h3>Projects</h3>
        <p><a href="projects.php">View my projects</a></p>
    </div>
    <div class="card">
        <h3>Contact Me</h3>
        <p><a href="contact.php">Get in touch</a></p>
    </div>
</div>
</body>
</html>