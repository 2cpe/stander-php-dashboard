<?php

session_start();

$host = "localhost";
$user = "root";
$pass = "";
$database = "anasx";

$link = mysqli_connect($host, $user, $pass);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

if (mysqli_select_db($link, $database)) {
    if (!isset($_SESSION['user_id'])) {
        die("Access denied! You must log in as admin.");
    }

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT role FROM users WHERE id = '$user_id'";
    $result = mysqli_query($link, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user['role'] != 'admin') {
        die("Access denied! Only admin can run this script.");
    }
}

mysqli_query($link, "DROP DATABASE IF EXISTS $database");
mysqli_query($link, "CREATE DATABASE $database");

mysqli_select_db($link, $database);

$sql_users = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(50) DEFAULT 'user',
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    city VARCHAR(50),
    country VARCHAR(50),
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
)";
mysqli_query($link, $sql_users);

$sql_products = "CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2),
    stock INT DEFAULT 0
)";
mysqli_query($link, $sql_products);

$sql_orders = "CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total DECIMAL(10,2),
    status VARCHAR(50) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($link, $sql_orders);

$admin_user = "admin";
$admin_pass = sha1("admin123"); 
$admin_email = "admin@anasx.com";

$sql_admin = "INSERT INTO users (username, password, email, role, first_name, last_name) 
              VALUES ('$admin_user', '$admin_pass', '$admin_email', 'admin', 'Anas', 'Admin')";
mysqli_query($link, $sql_admin);

mysqli_close($link);
session_unset();
session_destroy();

echo "Setup complete! Default admin created.";
echo "<br>Username: admin | Password: admin123";
?>