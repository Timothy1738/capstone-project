<?php
session_start();
include "../backend/connection.php";

$contactId = $_GET['contact_id'];
$currentUserId = $_SESSION['user_id']; // Assume you have a session with the current user ID

$sql = "SELECT m.message_id, m.message, m.sent_at, m.sender_id, m.delete_status,
               CASE WHEN m.sender_id = ? THEN 'you' ELSE u.username END AS sender, 
               CASE WHEN m.sender_id = ? THEN '' ELSE CONCAT(u.firstname, ' ', u.lastname) END AS sender_name 
        FROM messages m
        JOIN users u ON m.sender_id = u.user_id
        WHERE (m.sender_id = ? AND m.receiver_id = ?) OR (m.sender_id = ? AND m.receiver_id = ?)
        ORDER BY m.sent_at asc";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiiii", $currentUserId, $currentUserId, $currentUserId, $contactId, $contactId, $currentUserId);
$stmt->execute();
$result = $stmt->get_result();

$messages = array();
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);

$stmt->close();
$conn->close();
?>
