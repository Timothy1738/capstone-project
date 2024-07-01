<?php

session_start();

require_once "../../backend/connection.php";

if (isset($_FILES["photo"]["name"]) && !empty($_FILES["photo"]["name"])) {
    // Capture user_id
    $promoter_id = $_SESSION['promoter_id'];
    // echo $promoter_id;
    // exit();

    // Get the old image filename from the database
    $sql = "SELECT profile_picture FROM `promoter` WHERE `promoter_id` = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $promoter_id);
        $stmt->execute();
        $stmt->bind_result($old_image);
        $stmt->fetch();
        $stmt->close();
    }

    // Generate a unique name for the image
    $unique_name = uniqid() . '-' . basename($_FILES["photo"]["name"]);
    $target_dir = "../../dbimages/";
    $target_file = $target_dir . $unique_name;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        if ($old_image == "profile_img.png") {
            $sql = "UPDATE `promoter` SET profile_picture = ? WHERE promoter_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("si", $unique_name, $promoter_id);
                if ($stmt->execute()) {
                    header("location: ../profile.php?success=Profile+picture+updated+successfully");
                } else {
                    header("location: ../profile.php?error=Error+updating+profile+image: " . $stmt->error);
                }
                $stmt->close();
            } else {
                header("location: ../profile.php?error=Error+preparing+the+statement: " . $conn->error);
            }
        } else {
            // Delete the old image if it exists
            if (!empty($old_image) && file_exists($target_dir . $old_image)) {
                unlink($target_dir . $old_image);
            }
            
            $sql = "UPDATE `promoter` SET profile_picture = ? WHERE promoter_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("si", $unique_name, $promoter_id);
                if ($stmt->execute()) {
                    header("location: ../profile.php?success=Profile+picture+updated+successfully");
                } else {
                    header("location: ../profile.php?error=Error+updating+profile+image: " . $stmt->error);
                }
                $stmt->close();
            } else {
                header("location: ../profile.php?error=Error+preparing+the+statement: " . $conn->error);
            }
        }

        // Update the image name in the database
    } else {
        header("location: ../profile.php?error=Error+moving+the+uploaded+file.");
    }
} else {
    header("location: ../profile.php?error=Invalid Access Method");
}

$conn->close();
