<?php
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["video"])) {
    $user_id = $_POST['user_id'];
    $visibility = $_POST['visibility'];
    $description = $_POST['description'];

    // Handle File Upload
    $videoFile = $_FILES["video"];
    $maxFileSize = 100 * 1024 * 1024;

    if ($videoFile["size"] <= $maxFileSize) {
        $videoName = uniqid() . '_' . $videoFile["name"];
        $videoPath = "../dbvideos/" . $videoName;

        // Move File to Folder
        if (move_uploaded_file($videoFile["tmp_name"], $videoPath)) {
            // Insert Details into Database
            $sql = "INSERT INTO videos (user_id, visibility, description, video_url) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $user_id, $visibility, $description, $videoName);

            if ($stmt->execute()) {
                // Video uploaded successfully
                header("location: ../users/uploadvideo.php?success=Video+uploaded+successfully!");
            } else {
                // Error inserting into database
                header("location: ../users/uploadvideo.php?error=Error+uploading+video.+Please+try+again+later.");
            }

            $stmt->close();
        } else {
            // Error moving file to folder
            header("location: ../users/uploadvideo.php?error=Error+uploading+video.+Please+try+again+later.");
        }
    }else {
        header("location: ../users/uploadvideo.php?error=Error:+Video+file+size+should+be+less+than+50mbs");
    }
}
