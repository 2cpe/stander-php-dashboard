<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "anasx";

$link = mysqli_connect($hostname, $username, $password);

if (!$link) {
    die("CRITICAL ERROR: Connection to MySQL server failed. " . mysqli_connect_error());
}

if (!mysqli_select_db($link, $database)) {
    echo "<div style='background-color: #ffcccc; padding: 20px; border: 2px solid red; text-align: center;'>";
    echo "<h1>Database Not Found</h1>";
    echo "<p>The database '$database' is not installed or has not been created yet.</p>";
    echo "<p><a href='websitesetp.php' style='color: blue; font-weight: bold;'>Click here to run the website setup script</a></p>";
    echo "</div>";
    die();
}

mysqli_set_charset($link, "utf8mb4");
?>
