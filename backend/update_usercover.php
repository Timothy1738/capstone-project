<?php

require_once "connection.php";

if (isset($_FILES["cover_img"]["name"]) && !empty($_FILES["cover_img"]["name"])) {
    // Capture user_id
    $user_id = $_POST['user_id'];

    // Get the old image filename from the database
    $sql = "SELECT cover_picture FROM users WHERE user_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($old_image);
        $stmt->fetch();
        $stmt->close();
    }

    // Generate a unique name for the image
    $unique_name = uniqid() . '-' . basename($_FILES["cover_img"]["name"]);
    $target_dir = "../dbcoverimages/";
    $target_file = $target_dir . $unique_name;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["cover_img"]["tmp_name"], $target_file)) {

        // Delete the old image if it exists
        if ($old_image == "default_cover.jpg") {
            // Update the image name in the database
            $sql = "UPDATE users SET cover_picture = ? WHERE user_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("si", $unique_name, $user_id);
                if ($stmt->execute()) {
                    header("location: ../users/changecoverpicture.php");
                } else {
                    header("location: ../users/changecoverpicture.php?error=Error+updating+cover+image: " . $stmt->error);
                }
                $stmt->close();
            } else {
                header("location: ../users/changecoverpicture.php?error=Error+preparing+the+statement: " . $conn->error);
            }
        } else {
            if (!empty($old_image) && file_exists($target_dir . $old_image)) {
                unlink($target_dir . $old_image);
            }

            // Update the image name in the database
            $sql = "UPDATE users SET cover_picture = ? WHERE user_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("si", $unique_name, $user_id);
                if ($stmt->execute()) {
                    header("location: ../users/changecoverpicture.php");
                } else {
                    header("location: ../users/changecoverpicture.php?error=Error+updating+cover+image: " . $stmt->error);
                }
                $stmt->close();
            } else {
                header("location: ../users/changecoverpicture.php?error=Error+preparing+the+statement: " . $conn->error);
            }
        }
    } else {
        header("location: ../users/changecoverpicture.php?error=Error+moving+the+uploaded+file.");
    }
} else {
    echo "No file uploaded.\n";
}

$conn->close();
