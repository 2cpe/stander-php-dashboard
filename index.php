<?php
require "db.php";
?>

<!DOCTYPE html dir="rtl">
<html lang="ar">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>anasx site</title>
<link rel="stylesheet" href="style.css">
</head>

<body style="text-align: center; margin-top: 200px; font-size: 20px;">
    <h1>welcome to anasx.com</h1>
    <p>this website is under development by <a href="https://anasx.com" style="color: blue; text-decoration: none;">anasx.com</a>
    </p>
    <button
        style="margin: 5px; background-color: #3b5998; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
        <a style="color: white; text-decoration: none;" href="login.php">login</a>
    </button>
    <button
        style="margin: 5px; background-color: #3b5998; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
        <a style="color: white; text-decoration: none;" href="signup.php">signup</a>
    </button>
    <br>
    <?php
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            ?>
            <button
                style="margin: 5px; background-color: #505888ff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                <a style="color: white; text-decoration: none;" href="adminpanel.php">admin panel</a>
            </button>
            <?php
        }
    }
    ?>
</body>

</html>