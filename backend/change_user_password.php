<?php

require_once "functions.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $user_id = $_POST['user_id'];

    $updatePassword = updateUserPassword($user_id, $old_password, $new_password);

    // Check if the update was successful
    if (strpos($updatePassword, 'successfully') !== false) {
        // Redirect to the edit profile page with success message
        header("Location: ../users/changepassword.php?success=" . urlencode($updatePassword));
        exit();
    } else {
        // Redirect to the edit profile page with error message
        header("Location: ../users/changepassword.php?error=" . urlencode($updatePassword));
        exit();
    }
}