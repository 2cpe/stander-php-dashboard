<link rel="stylesheet" href="style.css">
<?php
require "db.php";

if(!$link){
    die("connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);
    
    $check_role_query = "SELECT role FROM users WHERE id = $id";
    $role_result = mysqli_query($link, $check_role_query);
    
    if ($role_result && mysqli_num_rows($role_result) > 0) {
        $role_data = mysqli_fetch_assoc($role_result);
        $role_to_delete = $role_data['role'];

        $query = "DELETE FROM users WHERE id = $id";
        
        if(mysqli_query($link, $query)){
            if ($role_to_delete === 'admin') {
                session_destroy();
                header("Location: login.php?message=admin_deleted");
                exit();
            } else {
                header("Location: adminpanel.php?message=user_deleted");
                exit();
            }
        } else {
            echo "error deleting user: " . mysqli_error($link);
        }
    } else {
        echo "User not found.";
    }
}

mysqli_close($link);
?>  