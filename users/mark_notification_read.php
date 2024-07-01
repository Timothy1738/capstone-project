<?php
include '../backend/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notificationId = $_POST['notification_id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE notification_id = ?");
    $stmt->bind_param("i", $notificationId);

    if ($stmt->execute()) {
        echo "Notification marked as read";
        //header("location: home.php");
    } else {
        echo "Error marking notification as read";
    }

    $stmt->close();
    $conn->close();
}
?>