<?php

require_once "connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $video_id = $_POST['video_id'];

    $sql = "DELETE FROM videos WHERE video_id = '$video_id'";
    $outcome = mysqli_query($conn, $sql);

    if($outcome) {
        header("location: ../users/profile.php?success=Video deleted successfully!");
    }else {
        header("location: ../users/video-video?error=something went wrong! failed to delete video&id=" .$video_id);
    }
}else {
    header("../users/logout.php?error=Invalid access method");
}
