<?php
session_start();
require "db.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
<link rel="stylesheet" href="style.css">
</head>
<body style="text-align: center; margin-top: 200px; font-size: 20px;">
    <h1>login page</h1>
    <p>this page is under development by <a href="https://www.instagram.com/2cpe/" style="color: blue; text-decoration: none;">2cpe</a>
    </p>
    <hr>
    
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="username" required>
        <br>
        <input type="password" name="password" placeholder="password" required>
        <br>
        <input type="submit" name="submit" value="login">
        <br>
        <a href="signup.php" style="display: inline-flex; align-items: center; gap: 6px;font-size: 15px; color: #3b5998; text-decoration: none;border-bottom: 1px solid currentColor; padding-bottom: 2px;transition: opacity 0.2s;">
        Don't have an account? →
        </a>
        <br>
        <a href="index.php" style="display: inline-flex; align-items: center; gap: 6px;font-size: 15px; color: #3b5998; text-decoration: none;border-bottom: 1px solid currentColor; padding-bottom: 2px;transition: opacity 0.2s;">
        Home →
        </a>
    </form>

    <?php
    if (isset($_SESSION['success_msg'])) {
        echo "<p style='color: green; font-weight: bold;'>" . $_SESSION['success_msg'] . "</p>";
        unset($_SESSION['success_msg']);
    }
    ?>

    <?php


if (isset($_POST['submit'])) {
    $user = mysqli_real_escape_string($link, $_POST['username']);
    $pass = $_POST['password']; // Don't escape yet, we will hash it
    $hashed_pass = sha1($pass);

    // sql query to select user from database
    // Values must be wrapped in single quotes in SQL
    $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$hashed_pass'";
    $result = mysqli_query($link, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Double check (though SQL already did it)
            if ($row['username'] == $_POST['username'] && $row['password'] == $hashed_pass) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['id'];
                
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<p style='color: red;'> Invalid username or password</p>";
            }
        } else {
            echo "<p style='color: red;'> Invalid username or password</p>";
        }
    } else {
        echo "<p style='color: red;'> Database error: " . mysqli_error($link) . "</p>";
    }
}
    ?>

</body>
</html>

