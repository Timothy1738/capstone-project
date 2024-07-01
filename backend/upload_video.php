<?php
require_once "connection.php";

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_POST['user_id'];
    $description = $_POST['description'];
    $status = "pending";
    $category_id = $_POST['category_id'];

    // Handle File Upload
    $videoFile = $_FILES["video"];
    $maxFileSize = 100 * 1024 * 1024; // 100MB

    if ($videoFile["size"] <= $maxFileSize) {
        $videoName = uniqid() . '_' . basename($videoFile["name"]);
        $videoPath = "../dbvideos/" . $videoName;

        // Move file to the specified directory
        if (move_uploaded_file($videoFile["tmp_name"], $videoPath)) {
            // Insert video details into the database
            $sql = "INSERT INTO videos (user_id, talentCategory, description, video_url, status, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("iisss", $user_id, $category_id, $description, $videoName, $status);

                if ($stmt->execute()) {
                    // Video uploaded successfully
                    header("Location: ../users/uploadvideo.php?success=Video+uploaded+successfully.+Wait+for+post+review");
                    exit();
                } else {
                    // Error inserting into database
                    header("Location: ../users/uploadvideo.php?error=Error+uploading+video.+Please+try+again+later.");
                    exit();
                }

                $stmt->close();
            } else {
                // Error preparing the statement
                header("Location: ../users/uploadvideo.php?error=Error+preparing+statement.+Please+try+again+later.");
                exit();
            }
        } else {
            // Error moving file to folder
            header("Location: ../users/uploadvideo.php?error=Error+uploading+video.+Please+try+again+later.");
            exit();
        }
    } else {
        header("Location: ../users/uploadvideo.php?error=Error:+Video+file+size+should+be+less+than+100MB.");
        exit();
    }
} else {
    echo "Error: Invalid request method or missing file.";
}