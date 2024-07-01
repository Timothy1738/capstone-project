<?php
include "connection.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $status = "Unread";

    $sql = "INSERT INTO `contact`(`name`, `email`, `subject`, `message`, `status`) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssss", $name, $email, $subject, $message, $status);
            if ($stmt->execute()) {
                header("location: ../index.php?success=Your+message+has+been+sent.+We shall+contact+you+as+soon+as+possible");
            } else {
                header("location: ../index.php?error=Error".$stmt->error);
            }
            $stmt->close();
        } else {
            header("location: ../index.php?error=Error" .$conn->error);
        }
}else {
    header("location: ../index.php?error=Invalid Access Method");
}
?>