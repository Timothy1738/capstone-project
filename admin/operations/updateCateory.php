<?php
include "../../backend/connection.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $record_id = $_POST['category_id'];
    $description = $_POST['desc'];
    $name = $_POST['name'];
    
    $sql = "UPDATE `category` SET `talent_Name` = ?, `Description` = ? WHERE `category_id` = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
    }
    
    $stmt->bind_param("ssi", $name, $description, $record_id);
    $result = $stmt->execute();
    
    if ($result) {
        header("location: ../updateCategory.php?success=Record updated successfully&id=".$record_id);
    } else {
        header("location: ../updateCategory.php?error=Something went wrong! Failed to update Record&id=".$record_id);
    }
    
    $stmt->close();
} else {
    header("location: ../updateCategory.php?error=Invalid Access Method&id=".$record_id);
}
?>
