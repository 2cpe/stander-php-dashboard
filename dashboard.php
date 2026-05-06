<link rel="stylesheet" href="style.css">
<?php
session_start();
require "db.php";



    
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($link, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    session_destroy();
    header("Location: login.php?error=user_not_found");
    exit();
}

$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f4; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 500px; margin: auto; }
        h1 { color: #333; }
        .info { margin-bottom: 20px; }
        .info p { margin: 5px 0; border-bottom: 1px solid #eee; padding: 5px 0; }
        .btn { display: inline-block; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-right: 10px; }
        .btn-logout { background-color: #f44336; color: white; }
        .btn-admin { background-color: #2196F3; color: white; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Welcome, <?php echo htmlspecialchars($user['first_name'] . " " . $user['last_name']); ?></h1>
        
        <div class="info">
            <p><b>Username:</b> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><b>Email:</b> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><b>Role:</b> <?php echo htmlspecialchars($user['role']); ?></p>
            <p><b>Location:</b> <?php echo htmlspecialchars($user['city'] . ", " . $user['country']); ?></p>
        </div>

        <div class="actions">
            <a href="logout.php" class="btn btn-logout">Logout</a>
            <?php if ($user['role'] == 'admin'): ?>
                <a href="adminpanel.php" class="btn btn-admin">Admin Panel</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>