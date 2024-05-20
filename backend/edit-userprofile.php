<?php

require_once "functions.php";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    
    $update = updateUserProfile($user_id, $firstname, $lastname);

    // Check if the update was successful
    if (strpos($update, 'successfully') !== false) {
        // Redirect to the edit profile page with success message
        header("Location: ../users/editprofile.php?success=" . urlencode($update));
        exit();
    } else {
        // Redirect to the edit profile page with error message
        header("Location: ../users/editprofile.php?error=" . urlencode($update));
        exit();
    }
}