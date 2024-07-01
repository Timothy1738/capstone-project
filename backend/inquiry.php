<?php
session_start();
include "./functions.php";
$user = get_user($_SESSION['user_id']);
$username = $user['username'];

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $outcome = inquiry($email, $name, $username, $subject, $message);
    if($outcome == true) {
        header("location: ../users/support.php?success=Message sent successfully! We shall get back to you as soon as possible!");
    }else {
        header("location: ../users/support.php?error=Opps! We are currently experiencing some difficulties, come back later");
    }
}else{
    header("location: ../users/support.php?error=Error! Invalid Access Method");
}
?>