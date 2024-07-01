<?php

include "connection.php";

if (isset($_POST['homefollow'])) {
    $follower_id = $_POST['follower_id'];
    $followee_id = $_POST['followee_id'];

    $sql = "INSERT INTO follows (follower_id, followee_id) VALUES (?, ?)";

    // Check if the user is trying to follow themselves
    if ($follower_id == $followee_id) {
        header("Location: ../users/home.php?error=You cannot follow yourself");
        exit();
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO follows (follower_id, followee_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("ii", $follower_id, $followee_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect or handle success
            header("Location: ../users/home.php?success=Follow successful");
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

if (isset($_POST['follow'])) {
    $follower_id = $_POST['follower_id'];
    $followee_id = $_POST['followee_id'];
    $video_id = $_POST['video_id'];

    $sql = "INSERT INTO follows (follower_id, followee_id) VALUES (?, ?)";

    // Prepare the SQL statement
    $sql = "INSERT INTO follows (follower_id, followee_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("ii", $follower_id, $followee_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect or handle success
            header("Location: ../users/view-PersonsVideo.php?success=Follow successful&id=" . $video_id ."&usid=" .$followee_id);
        } else {
            // Handle execution error
            header("Location: ../users/view-PersonsVideo.php?error=Error executing query&id=" . $video_id ."&usid=" .$followee_id);
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle preparation error
        header("Location: ../users/view-PersonsVideo.php?error=Error preparing statement&id=" . $video_id ."&usid=" .$followee_id);
    }
}
$conn->close();
