<?php
include "./functions.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $contact = $_POST['tel'];
    $text = $_POST['text'];
    $status = "Mark As Read";

    $outcome = eventsub($email, $contact, $text, $status);
    if ($outcome == true) {
        header("location: ../index.php?success=Thank you for advertising us, we shall get back to you as soon as possible");
    } else {
        header("location: ../index.php?error=Oops, Something went wrong! come back later");
    }
} else {
    header("location: ../index.php?error=Error! Invalid Access Method");
}
