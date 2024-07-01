<?php
session_start();
include "../../backend/connection.php";

if (isset($_POST['home_deny'])) {
    $video_id = $_POST['video_id'];
    $status = "denied";
    $approver_id = $_SESSION['admin_id'];

    $sql = "UPDATE `videos` SET `status` = '$status', `approver_id` = '$approver_id' WHERE `video_id` = '$video_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("location: ../approvals.php?success=Video blocked successfully!");
        // approvalNotification($user_id, $video_id, $type, $tablename, $approver_id, $is_read);
    } else {
        header("location: ../approvals.php?error=Something went wrong! Failed to update status");
    }
} else {
    header("location: ../approvals.php?error=Invalid access method");
}

if (isset($_POST['deny'])) {
    $video_id = $_POST['video_id'];
    $status = "denied";
    $approver_id = $_SESSION['admin_id'];

    $sql = "UPDATE `videos` SET `status` = '$status', `approver_id` = '$approver_id' WHERE `video_id` = '$video_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("location: ../specific_videoApproval.php?success=Video blocked successfully!&id=".$video_id);
        // approvalNotification($user_id, $video_id, $type, $tablename, $approver_id, $is_read);
    } else {
        header("location: ../specific_videoApproval.php?error=Something went wrong! Failed to update status&id=".$video_id);
    }
} else {
    header("location: ../history.php?error=Invalid access method");
}
