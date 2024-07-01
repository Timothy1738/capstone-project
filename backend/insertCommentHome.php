<?php

require_once "connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $comment = $_POST['comment'];
    $video_id = $_POST['video_id'];

    $sql = "INSERT INTO `comments`(`user_id`, `video_id`, `content`) VALUES 
    ('$user_id','$video_id','$comment')";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header("location: ../users/home.php");
    }else {
        header("location: ../users/home.php");
    }
}