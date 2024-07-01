<?php
session_start();
include "../../backend/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contact = $_POST['phone'];
    $admin_id = $_SESSION['admin_id'];

    $sql = "UPDATE `admin` SET `firstname`=?,`lastname`=?,`email`=?,`contact`=? WHERE `admin_id` = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssi", $fname, $lname, $email,$contact, $admin_id);
        if ($stmt->execute()) {
            header("location: ../profile.php?success=Profile updated successfully");
        } else {
            header("location: ../profile.php?error=Error! Something went wrong, failed to update profile");
        }
        $stmt->close();
    } else {
        header("location: ../profile.php?error=Error+preparing+the+statement: " . $conn->error);
    }
}else {
    header("location: ../profile.php?error=Error! Invalid access method");
}
