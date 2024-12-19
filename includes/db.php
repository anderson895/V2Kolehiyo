<?php
// Database configuration
$host = 'localhost';
$db_name = 'portfolio_db'; // Replace with your database name
$db_user = 'root'; // Default username for Laragon
$db_password = ''; // Default password is empty

// Create a connection
$dsn = new mysqli($host, $db_user, $db_password, $db_name);

// Check connection
if ($dsn->connect_error) {
    die("Connection failed: " . $dsn->connect_error);
} else {
    // echo "Connected successfully to the database: " . $db_name;
}

$dsn->set_charset('utf8mb4');
?>
