<?php
session_start();
include "./connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $category_id = $_POST['category_id'];
    $creator_status = "creator";

    $sql = "UPDATE `users` SET `category_id` = ?, `creator_status` = ? WHERE `user_id` = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("isi", $category_id, $creator_status, $user_id);

        if ($stmt->execute()) {
            header("location: ../users/uploadvideo.php?success=Congrats!+your+profile+has+been+updated.+Start+uploading+videos+now+😊");
        } else {
            header("location: ../users/creator.php?error=Oops!+Something+went+wrong!+Try+again+later");
        }

        $stmt->close();
    } else {
        header("location: ../users/creator.php?error=Oops!+Something+went+wrong!+Try+again+later");
    }
} else {
    header("location: ../users/logout.php");
}
?>
