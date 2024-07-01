<?php
session_start();
include "../../backend/connection.php";

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $status = "valid";
    $deleted_by = 0;

    $update = "UPDATE `users` SET `delete_status`='$status', `deleted_by`='$deleted_by' WHERE `user_id` = '$user_id'";
    $execute = mysqli_query($conn, $update);
    if ($execute) {
        header("location: ../users.php?success=User Account Unblocked successfully!");
    } else {
        header("location: ../users.php?error=Something went wrong! Failed to unblock user");
    }
} else {
    header("location: ../users.php?error=Invalid Access Method");
}
