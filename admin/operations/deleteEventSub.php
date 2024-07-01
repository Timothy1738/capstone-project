<?php
include "../../backend/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table_id = $_POST['table_id'];
    $sql = "DELETE FROM `event_subs` WHERE table_id = '$table_id'";
    $outcome = mysqli_query($conn, $sql);
    if ($outcome) {
        header("location: ../eventsubs.php?success=Record deleted successfully!");
        exit();
    } else {
        header("location: ../eventsubs.php?error=Opps, something went wrong");
        exit();
    }
} else {
    header("location: ../eventsubs.php?error=Error! Invalid Access Method!");
    exit();
}
