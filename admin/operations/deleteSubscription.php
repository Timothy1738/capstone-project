<?php
include "../../backend/connection.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_id = $_POST['newsLetter_id'];
    $SQL = "DELETE FROM `newsletter` WHERE `news_letter_id` = $email_id";
    $result = mysqli_query($conn, $SQL);

    if($result) {
        header("location: ../newsLetter.php?success=Subscription deleted successfully!");
    }else {
        header("location: ../newsLetter.php?error=Something went wrong! Failed to delete record!");
    }
}else {
    header("location: ../newsLetter.php?error=Error! Invalid Access Method");
}
?>