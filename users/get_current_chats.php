<?php
include "../backend/connection.php";

// Start session to get the current user ID
session_start();
$currentUserId = $_SESSION['user_id'];

// Prepare the SQL query to get current chats
$sql = "
    SELECT 
        u.user_id, 
        CONCAT(u.firstname, ' ', u.lastname) AS name, 
        u.profile_picture, 
        m.message AS latest_message, 
        m.sent_at AS latest_timestamp
    FROM 
        users u
    JOIN (
        SELECT 
            GREATEST(sender_id, receiver_id) AS user1,
            LEAST(sender_id, receiver_id) AS user2,
            MAX(message_id) AS max_message_id
        FROM 
            messages
        WHERE 
            sender_id = ? OR receiver_id = ?
        GROUP BY 
            GREATEST(sender_id, receiver_id),
            LEAST(sender_id, receiver_id)
    ) latest_chats ON (u.user_id = latest_chats.user1 OR u.user_id = latest_chats.user2) AND u.user_id != ?
    JOIN messages m ON m.message_id = latest_chats.max_message_id
    ORDER BY m.sent_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $currentUserId, $currentUserId, $currentUserId);
$stmt->execute();
$result = $stmt->get_result();

$chats = array();
while ($row = $result->fetch_assoc()) {
    $chats[] = $row;
}

echo json_encode($chats);

$stmt->close();
$conn->close();
?>
