<?php
include "connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $video_id = $_POST['video_id'];
    $user_id = $_POST['user_id'];

    $sql = "INSERT INTO votes (user_id, video_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("ii", $user_id, $video_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect or handle success
            header("Location: ../users/home.php?success=Thank you for voting!");
        } else {
            // Handle execution error
            header("Location: ../users/home.php?error=Error executing query");
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle preparation error
        header("Location: ../users/home.php?error=Error preparing statement");
    }
} else {
    // Handle invalid request method
    header("Location: ../users/logout.php?error=Invalid request method");
}
$conn->close();

?>