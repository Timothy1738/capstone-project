<?php
session_start();
include "../backend/connection.php";

$query = $_GET['query'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT user_id, CONCAT(firstname, ' ', lastname) AS `name`, profile_picture 
FROM users 
WHERE (firstname LIKE ? OR lastname LIKE ? OR username LIKE ?) AND user_id != ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%{$query}%";
$stmt->bind_param("sssi", $searchTerm, $searchTerm, $searchTerm, $user_id); // bind the parameter three times
$stmt->execute();
$result = $stmt->get_result();

$users = array();
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);

$stmt->close();
$conn->close();
?>
