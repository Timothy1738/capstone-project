<?php
require_once "connection.php";

if (isset($_POST['homeunfollow'])) {
    // Retrieve POST data
    $follower_id = $_POST['follower_id'];
    $followee_id = $_POST['followee_id'];

    // Prepare the SQL statement
    $sql = "DELETE FROM follows WHERE follower_id = ? AND followee_id = ?";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("ii", $follower_id, $followee_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect or handle success
            header("Location: ../users/home.php?success=" . urlencode("Unfollow Successful"));
        } else {
            // Handle execution error
            header("Location: ../users/home.php?error=" . urlencode("Something went wrong!"));
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle preparation error
        header("Location: ../users/home.php?error=" . urlencode("Error preparing statement"));
    }
}

if(isset($_POST['unfollow'])) {
    // Retrieve POST data
    $follower_id = $_POST['follower_id'];
    $followee_id = $_POST['followee_id'];
    $video_id = $_POST['video_id'];

    // Prepare the SQL statement
    $sql = "DELETE FROM follows WHERE follower_id = ? AND followee_id = ?";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("ii", $follower_id, $followee_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect or handle success
            header("Location: ../users/view-personsVideo.php?success=" . urlencode("Unfollow Successful") ."&id=" . $video_id . "&usid=" . $followee_id);
        } else {
            // Handle execution error
            header("Location: ../users/view-personsVideo.php?error=" . urlencode("Something went wrong!") ."&id=" . $video_id . "&usid=" . $followee_id);
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle preparation error
        header("Location: ../users/view-personsVideo.php?error=" . urlencode("Error preparing statement") ."&id=" . $video_id . "&usid=" . $followee_id);
    }
}

$conn->close();
?>