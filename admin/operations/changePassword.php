<?php
session_start();
include "../../backend/connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newpass  = $_POST['cpass'];
    $createpass = $_POST['conpass'];
    $admin_id = $_SESSION['admin_id'];

    if($newpass === $createpass ) {
        $hashedPass = password_hash($newpass, PASSWORD_BCRYPT);
        $sql = "UPDATE `admin` SET `password` = '$hashedPass' WHERE `admin_id` = $admin_id";
        $result = mysqli_query($conn, $sql);

        if($result) {
            header("location: ../profile.php?success=Password updated successfully");
        }else {
            header("location: ../profile.php?error=Something went wrong, failed to update password!");
        }
    }else {
        header("location: ../profile.php?error=Passwords entered do not match");
    }
}else {
    header("location: ../profile.php?error=Invalid Access method");
}
?>