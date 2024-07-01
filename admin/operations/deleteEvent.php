<?php

include "../../backend/connection.php";
function getEventImg($event_id) {
    global $conn;
    $sql = "SELECT `thumbnail` FROM `events` WHERE `event_id`";
    $result = mysqli_query($conn, $sql);
    if($result) {
        $row = mysqli_fetch_array($result);
        $thumbnail = $row['thumbnail'];
        return $thumbnail;
    }else {
        return "error!";
    }
}

if(isset($_GET['id'])) {
    $event_id = $_GET['id'];
    $sql = "DELETE FROM `events` WHERE `event_id` = $event_id";
    $outcome = mysqli_query($conn, $sql);
    $old_image = getEventImg($event_id);
    $target_dir = "../../dbimages/";
    if($outcome) {
        if (!empty($old_image) && file_exists($target_dir . $old_image)) {
            unlink($target_dir . $old_image);
        }
        header("location: ../events.php?success=Event Deleted Successfully!");
        exit();
    }else {
        header("location: ../events.php?error=Opps! Something went wrong!");
        exit();
    }
}else {
    header("location: ../events.php?error=Error! Invalid Access Method");
    exit();
}
?>