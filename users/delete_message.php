<?php
include "../backend/connection.php";

$messageId = $_POST['message_id'];

$delete_status = "invalid";

$sql = "UPDATE messages SET delete_status = ? WHERE message_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $delete_status, $messageId);
$stmt->execute();

// Check if the deletion was successful
if ($stmt->affected_rows > 0) {
    // Send a success response
    echo json_encode(array("success" => true));
} else {
    // Send an error response
    echo json_encode(array("success" => false, "message" => "Failed to delete message."));
}

$stmt->close();
$conn->close();
?>
