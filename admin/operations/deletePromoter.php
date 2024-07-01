<?php
include "../../backend/connection.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $promoter_id = $_POST['promoter_id'];
    // echo $promoter_id;
    // exit();

    $sql = "DELETE FROM `promoter` WHERE `promoter_id` ='$promoter_id'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header("location: ../promoters.php?success=Promoter deleted successfully");
    }else {
        header("location: ../promoters.php?error=Something went wrong! Failed to remove admin");
    }
}else {
    header("location: ../promoters.php?error=Invalid Access Method");
}
?>