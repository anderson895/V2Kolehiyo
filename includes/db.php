<?php
// Database configuration
$host = 'localhost';
$db_name = 'portfolio_db'; 
$db_user = 'root'; 
$db_password = ''; 

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
