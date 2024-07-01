<?php
include "../../backend/connection.php";

if (isset($_GET['id'])) {
    $table_id = $_GET['id'];
    $status = "Read";
    $sql = "UPDATE `event_subs` SET `status`='Read' WHERE `table_id`='$table_id'";
    $outcome = mysqli_query($conn, $sql);
    if ($outcome) {
        header("location: ../eventsubs.php?success=Operation successfull!");
        exit();
    } else {
        header("location: ../eventsubs.php?error=Opps, something went wrong");
        exit();
    }
} else {
    header("location: ../eventsubs.php?error=Error! Invalid Access Method!");
    exit();
}
?>