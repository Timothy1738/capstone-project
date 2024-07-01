<?php
session_start();
require_once "../../backend/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand_name =$_POST['name'];
    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $profile_img = "profile_img.png";
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $created_by = $_SESSION['admin_id'];
    $category = $_POST['talentcategory'];


    $email_validate = validate_user_email($email);
    $contact_validate = validate_user_phone($contact);
    $username_validate = validate_user_username($username);

    if ($email_validate == "exists") {
        header("location: ../promoters.php?error=Email+aready+taken");
    } elseif ($contact_validate == "exists") {
        header("location: ../promoters.php?error=Contact+already+exists");
    } elseif ($username_validate == "exists") {
        header("location: ../promoters.php?error=Username+already+taken");
    } else {
        $sql = "INSERT INTO `promoter`(`talentCategory`,`username`, `email`, `contact`, `brand_name`, `password`, `profile_picture`, `created_by`) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("issssssi", $category, $username, $email, $contact, $brand_name, $password, $profile_img, $created_by);
            if ($stmt->execute()) {
                header("location: ../promoters.php?success=Promoter Added successfully!");
            } else {
                header("location: ../promoters.php?error=Error".$stmt->error);
            }
            $stmt->close();
        } else {
            header("location: ../promoters.php?error=Error" .$conn->error);
        }
    }
    $conn->close();
} else {
    header("location: ../promoters.php?error=Error! Invalid request method");
}
?>