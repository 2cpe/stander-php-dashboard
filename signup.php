
<?php
session_start();
require "db.php";

$message = "";
$message_type = "";

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = $_POST['password'];
    $email = mysqli_real_escape_string($link, $_POST['email']);
    
    // Hash the password to match the login system
    $hashed_password = sha1($password);

    // Check if username or email already exists
    $check_sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $check_result = mysqli_query($link, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $message = "Username or Email already exists!";
        $message_type = "red";
    } else {
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
        $result = mysqli_query($link, $sql);
        if ($result) {
            // Success! Store a message and redirect
            $_SESSION['success_msg'] = "User created successfully! Please login.";
            header("Location: login.php");
            exit();
        } else {
            $message = "Error creating user: " . mysqli_error($link);
            $message_type = "red";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>

<link rel="stylesheet" href="style.css">
</head>
<body style="text-align: center; margin-top: 200px; font-size: 20px;">
    <h1>signup page</h1>
    <p>this page is under development by <a href="https://www.instagram.com/2cpe/" style="color: blue; text-decoration: none;">2cpe</a>
    </p>
    <button
        style="margin: 5px; background-color: #3b5998; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
        <a style="color: white; text-decoration: none;" href="login.php">login</a>
    </button>
    <button
        style="margin: 5px; background-color: #3b5998; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
        <a style="color: white; text-decoration: none;" href="signup.php">signup</a>
    </button>
    <hr>
    
    <form action="signup.php" method="post">
        <input type="text" name="username" placeholder="username" required>
        <br>
        <input type="password" name="password" placeholder="password" required>
        <br>
        <input type="email" name="email" placeholder="exam@gmail.com" required>
        <br>
        <input type="submit" name="submit" value="signup">
    </form>

    <?php
    if ($message != "") {
        echo "<p style='color: $message_type;'>$message</p>";
    }
    ?>

</body>
</html>


