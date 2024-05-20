<?php

require_once "functions.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $visibility= $_POST['visibility'];
    $video_id = $_POST['video_id'];

    $updateVisibility = updateVisbility($visibility, $video_id);

    // Check if the update was successful
    if (strpos($updateVisibility, 'successfully') !== false) {
        // Redirect to the edit profile page with success message
        header("Location: ../users/view-video.php?id=" . $video_id . "&success=" . urlencode($updateVisibility));
        exit();
    } else {
        // Redirect to the edit profile page with error message
        header("Location: ../users/view-video.php?id=" . $video_id . "&error=" . urlencode($updateVisibility));
        exit();
    }
}