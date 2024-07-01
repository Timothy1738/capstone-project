<?php
include "../../backend/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $video_id = $_POST['video_id'];

    $sql = "DELETE FROM `videos` WHERE `video_id` = '$video_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("location: ../history.php?success=Video+deleted+successfully!");
        // approvalNotification($user_id, $video_id, $type, $tablename, $approver_id, $is_read);
    } else {
        header("location: ../history.php?error=Error!+Something+went+wrong!+Failed+to+delete+video");
    }
} else {
    header("location: ../history.php?error=Invalid access method");
}
