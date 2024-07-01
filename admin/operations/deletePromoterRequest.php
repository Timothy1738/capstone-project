<?php
include "../../backend/connection.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $record_id = $_POST['id'];

    $sql = "DELETE FROM `promoter_requests` WHERE `request_id` = '$record_id'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header("location: ../promoterRequests.php?success=Record deleted successfully!");
    }else {
        header("location: ../promoterRequests.php?error=Something went wrong! Failed to delete record!");
    }
}else {
    header("location: ../promoterRequests.php?error=Invalid Access Method");
}
?>