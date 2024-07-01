<?php
include "../../backend/connection.php";
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message_id = $_POST['message_id'];

    $sql = "DELETE FROM contact WHERE contact_id = '$message_id'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header("location: ../homeMessages.php?success=Message deleted successfully");
    }else {
        header("location: ../homeMessages.php?error=Something went wrong! Failed to delete message");
    }
} else {
    header("location: ../homeMessages.php?error=Invalid Access Method");
}
?>