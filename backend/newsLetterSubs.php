<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $select = "SELECT * FROM `newsletter` WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) == 1) {
        header("location: ../index.php?error=You have already subscribed!");
    } else {
        $sql = "INSERT INTO `newsletter`(`email`) VALUES ('$email')";
        $data = mysqli_query($conn, $sql);
        if ($data) {
            header("location: ../index.php?success=Your email has been added to our news letter subscriptions!");
        } else {
            header("location: ../index.php?error=Something went wrong! Try again later");
        }
    }
} else {
    header("location: ../index.php?error=Error! Invalid access method");
}
