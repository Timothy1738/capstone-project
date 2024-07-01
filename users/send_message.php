<?php
include "../backend/connection.php";
include "../backend/functions.php";
session_start();
header('Content-Type: application/json');

if (!isset($_POST['contact_id']) || !isset($_POST['message'])) {
    echo json_encode(["success" => false, "error" => "Missing contact_id or message"]);
    exit;
}

$contact_id = $_POST['contact_id'];
$message = $_POST['message'];
$sender_id = $_SESSION['user_id'];
$fname = getFname($sender_id);
$delete_status = "valid";
$notification = "New message from" . ' ' . $fname;

$sql = "INSERT INTO messages (`sender_id`, `receiver_id`, `message`, `delete_status`) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $sender_id, $contact_id, $message, $delete_status);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
    insertNotification($contact_id, $notification);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
