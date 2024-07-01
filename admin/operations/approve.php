<?php
session_start();

include "../../backend/functions.php";

if (isset($_POST['approve'])) {
    $video_id = $_POST['video_id'];
    $approver_id = $_SESSION['admin_id'];
    $status = "approved";

    $user_id = $_POST['user_id'];
    $tablename = "admin";
    $type = "approval";
    $is_read = 0;

    $sql = "UPDATE `videos` SET `status` = '$status', `approver_id` = '$approver_id' WHERE `video_id` = '$video_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("location: ../approvals.php?success=Video has been approved");
        // approvalNotification($user_id, $video_id, $type, $tablename, $approver_id, $is_read);
    } else {
        header("location: ../approvals.php?error=Something went wrong! Failed to update status");
    }
} else {
    //header("location: ../approvals.php?error=Invalid access method");
    echo "approve from approvals page";
}

if (isset($_POST['submit'])) {
    $video_id = $_POST['video_id'];
    $approver_id = $_SESSION['admin_id'];
    $status = "approved";

    $user_id = $_POST['user_id'];
    $tablename = "admin";
    $type = "approval";
    $is_read = 0;

    $sql = "UPDATE `videos` SET `status` = '$status', `approver_id` = '$approver_id' WHERE `video_id` = '$video_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("location: ../specific_videoApproval.php?success=Video+has+been+approved&id=".$video_id);
        // approvalNotification($user_id, $video_id, $type, $tablename, $approver_id, $is_read);
    } else {
        header("location: ../specific_videoApproval.php?error=Something+went wrong!+Failed+to+update+status&id=".$video_id);
    }
} else {
    //header("location: ../history.php?error=Invalid access method");
    echo "approve from specific page";
}