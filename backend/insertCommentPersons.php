<?php

require_once "connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $comment = $_POST['comment'];
    $video_id = $_POST['video_id'];
    $person_id = $_POST['person_id'];

    $sql = "INSERT INTO `comments`(`user_id`, `video_id`, `content`) VALUES 
    ('$user_id','$video_id','$comment')";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header("location: ../users/view-personsVideo.php?id=" .$video_id ."&usid=".$person_id);
    }else {
        header("location: ../users/view-personsVideo.php?id=" . $video_id ."&usid=".$person_id);
    }
}