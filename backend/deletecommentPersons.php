<?php

include "connection.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment_id = $_POST['comment_id'];
    $video_id = $_POST['video_id'];
    $user_id = $_POST['user_id'];
    $person_id = $_POST['person_id'];
    $sql = "DELETE FROM comments WHERE comment_id = $comment_id";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header("location: ../users/view-personsVideo.php?id=".$video_id ."&usid=".$person_id);
    }else {
        header("location: ../users/view-personsVideo.php?id=".$video_id ."&usid=".$person_id);
    }
}