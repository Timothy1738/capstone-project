<?php


require_once "functions.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = removeSpaces($_POST['username']);
    $user_id = $_POST['user_id'];

    $validateUsername = validateUsername($user_id, $username);
    if ($validateUsername == "exists") {
        header("location: ../users/changeusername.php?error=Username+already+taken!");
    } else {
        $updateUsername = updateUsername($username, $user_id);
        // Check if the update was successful
        if (strpos($updateUsername, 'successfully') !== false) {
            // Redirect to the edit profile page with success message
            header("Location: ../users/changeusername.php?success=" . urlencode($updateUsername));
            exit();
        } else {
            // Redirect to the edit profile page with error message
            header("Location: ../users/changeusername.php?error=" . urlencode($updateUsername));
            exit();
        }
    }
}
