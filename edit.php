
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit table</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
        <input type="text" name="username" placeholder="username" required>
        <br>
        <input type="password" name="password" placeholder="password" required>
        <br>
        <input type="email" name="email" placeholder="email" required>
        <br>
        <input type="text" name="first_name" placeholder="first name" required>
        <br>
        <input type="text" name="last_name" placeholder="last name" required>
        <br>
        <input type="text" name="city" placeholder="city" required>
        <br>
        <input type="text" name="country" placeholder="country" required>
        <br>
        <input type="text" name="phone" placeholder="phone" required>
        <br>
        <input type="submit" name="submit" value="update">
    <?php

require "db.php";
$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];

    $query = "UPDATE users SET username = '$username', password = '$password', email = '$email', first_name = '$first_name', last_name = '$last_name', city = '$city', country = '$country', phone = '$phone' WHERE id = $id";
    $result = mysqli_query($link, $query);
    if ($result) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user: " . mysqli_error($link);
    }
}

mysqli_close($link);
?>  
    </form>
</body>
</html>