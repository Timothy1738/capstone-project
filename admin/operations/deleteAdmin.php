<?php
include "../../backend/connection.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_id = $_POST['admin_id'];
    $sql = "DELETE FROM admin WHERE admin_id = '$admin_id'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header("location: ../view-admin.php?success=Admin deleted successfully");
    }else {
        header("location: ../view-admin.php?error=Something went wrong! Failed to remove admin");
    }
}else {
    header("location: ../view-admin.php?error=Invalid Access Method");
}
?>