<?php
include "../backend/connection.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if (!isset($_POST['contact_id'])) {
    echo json_encode(['success' => false, 'message' => 'Contact ID is required']);
    exit;
}

$contactId = intval($_POST['contact_id']);

// Assuming the current user ID is stored in the session
session_start();
$currentUserId = $_SESSION['user_id'];

if (!$currentUserId) {
    echo json_encode(['success' => false, 'message' => 'User not authenticated']);
    exit;
}

// Start transaction
$conn->begin_transaction();

try {
    // Delete messages between the current user and the contact
    $stmt = $conn->prepare("DELETE FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)");
    $stmt->bind_param("iiii", $currentUserId, $contactId, $contactId, $currentUserId);

    if ($stmt->execute()) {
        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'Chat deleted successfully']);
    } else {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Failed to delete chat']);
    }

    $stmt->close();
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
}

$conn->close();
?>
