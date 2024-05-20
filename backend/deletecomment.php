<?php

include "connection.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment_id = $_POST['comment_id'];
    $video_id = $_POST['video_id'];    
    $sql = "DELETE FROM comments WHERE comment_id = $comment_id";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header("location: ../users/view-video.php?id=".$video_id);
    }else {
        header("location: ../users/view-video.php?id=".$video_id);
    }
}