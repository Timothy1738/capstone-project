<?php
require_once "connection.php";
require_once "functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $profile_img = "profile_img.png";
    $cover_img = "default_cover.jpg";
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $username = $_POST['username'];
    $dob = $_POST['dob'];
    $delete_status = "valid";
    $created_by = "self";
    $sex = $_POST['sex'];

    $email_validate = validate_user_email($email);
    $contact_validate = validate_user_phone($contact);
    $username_validate = validate_user_username($username);

    if ($email_validate == "exists") {
        header("location: ../signup.php?error=Email+aready+taken");
    } elseif ($contact_validate == "exists") {
        header("location: ../signup.php?error=Contact+already+exists");
    } elseif ($username_validate == "exists") {
        header("location: ../signup.php?error=Username+already+taken");
    } else {
        $sql = "INSERT INTO `users`(`username`, `email`, `password`, `profile_picture`, `cover_picture`, `sex`,`contact`, `firstname`, `lastname`, `dob`, `delete_status`, `created_by`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssssssssssss", $username, $email, $password, $profile_img, $cover_img, $sex, $contact, $firstName, $lastName, $dob, $delete_status, $created_by);
            if ($stmt->execute()) {
                header("location: ../signup.php?success=Your+account+has+been+created+successfully!+Login+with+your+email+and+password");
            } else {
                $response['message'] = 'Error: ' . $stmt->error;
                header("location: ../signup.php?error=".$stmt->error);
            }
            $stmt->close();
        } else {
            header("location: ../signup.php?error=" .$conn->error);
        }
    }
    $conn->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}
?>