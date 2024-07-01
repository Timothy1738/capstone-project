<?php
include "../backend/connection.php";

header('Content-Type: application/json');

if (!isset($_GET['contact_id'])) {
    echo json_encode(["error" => "Missing contact_id"]);
    exit;
}

$contact_id = $_GET['contact_id'];

$sql = "SELECT user_id, CONCAT(firstname, ' ', lastname) AS name, profile_picture FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $contact_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $contact = $result->fetch_assoc();
    echo json_encode($contact);
} else {
    echo json_encode(["error" => "No contact found"]);
}

$stmt->close();
$conn->close();
?>
