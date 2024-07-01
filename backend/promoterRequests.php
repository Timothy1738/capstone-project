<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $brand = $_POST['brand'];
    $contact = $_POST['contact'];
    $talent = $_POST['talent'];

    $mydata = "SELECT * FROM `promoter_requests` WHERE `email` = '$email' OR `contact` = '$contact'";
    $everything = mysqli_query($conn, $mydata);

    if (mysqli_num_rows($everything) > 0) {
        header("location: ../index.php?error=We already recieved your application! Thankyou");
    } else {
        $select = "INSERT INTO `promoter_requests`(`talent_area`, `brand_name`, `email`, `contact`) 
    VALUES ('$talent','$brand','$email','$contact')";
        $result = mysqli_query($conn, $select);
        if ($result) {
            header("location: ../index.php?success=Recieved successfully! Thank you");
        } else {
            header("location: ../index.php?error=Something went wrong! Try again later");
        }
    }
} else {
    header("location: ../index.php?error=Error! Invalid access method");
}
