<?php
include "../../backend/connection.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $record_id = $_POST['category_id'];
    
    $sql = "DELETE FROM `category` WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
    }
    
    $stmt->bind_param("i", $record_id);
    $result = $stmt->execute();
    
    if ($result) {
        header("location: ../category.php?success=Record deleted successfully");
    } else {
        header("location: ../category.php?error=Something went wrong! Failed to delete Record");
    }
    
    $stmt->close();
} else {
    header("location: ../category.php?error=Invalid Access Method");
}
?>