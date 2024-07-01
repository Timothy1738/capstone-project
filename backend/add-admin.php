<?php
require_once "connection.php";
require_once "functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $profile_img = "profile_img.png";
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $username = $_POST['username'];
    $delete_status = "valid";
    $created_by = $_POST['user_id'];

    $email_validate = validate_user_email($email);
    $contact_validate = validate_user_phone($contact);
    $username_validate = validate_user_username($username);

    if ($email_validate == "exists") {
        header("location: ../admin/view-admin.php?error=Email+aready+taken");
    } elseif ($contact_validate == "exists") {
        header("location: ../admin/view-admin.php?error=Contact+already+exists");
    } elseif ($username_validate == "exists") {
        header("location: ../admin/view-admin.php?error=Username+already+taken");
    } else {
        $sql = "INSERT INTO `admin`(`firstname`, `lastname`, `email`, `contact`, `profile_picture`, `password`, `username`, `delete_status`, `created_by`) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssssssss", $firstName, $lastName, $email, $contact, $profile_img, $password, $username, $delete_status, $created_by);
            if ($stmt->execute()) {
                header("location: ../admin/view-admin.php?success=Admin created successfully");
            } else {
                header("location: ../admin/view-admin.php?error=Error".$stmt->error);
            }
            $stmt->close();
        } else {
            header("location: ../admin/view-admin.php?error=Error" .$conn->error);
        }
    }
    $conn->close();
} else {
    header("location: ../admin/view-admin.php?error=Error! Invalid request method");
}
?>