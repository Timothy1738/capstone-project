<?php
session_start();
include "../../backend/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['desc'];
    $created_by = $_SESSION['admin_id'];
    $stmt = $conn->prepare("INSERT INTO `category`(`talent_Name`, `Description`, `created_by`) VALUES (?,?,?)");
    $stmt->bind_param("ssi", $name, $description, $created_by);

    if ($stmt->execute()) {
        header("Location: ../category.php?success=New+Talent+Category+Added+successfully!");
        exit();
    } else {
        header("Location: ../category.php?error=Something+went+wrong!+Failed+to+add+new+category!");
        exit();
    }
    $stmt->close();
}else {
    header("location: ../category.php?error=Invalid+Access+Method");
}
