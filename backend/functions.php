<?php

require_once "connection.php";

function removeSpaces($string)
{
    return str_replace(' ', '', $string);
}

function validate_user_email($email)
{
    global $conn;
    $sql = "SELECT COUNT(*) AS count FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Check if the email exists
    if ($count > 0) {
        // Email exists
        return "exists";
    } else {
        // Email not found
        return "proceed";
    }
}

function validate_user_username($username)
{
    global $conn;
    $sql = "SELECT COUNT(*) AS count FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Check if the email exists
    if ($count > 0) {
        // Email exists
        return "exists";
    } else {
        // Email not found
        return "proceed";
    }
}

function validateUsername($user_id, $username)
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM users WHERE username = ? AND user_id != ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $username, $user_id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Check if the username exists
    if ($count > 0) {
        // Username exists
        return "exists";
    } else {
        // Username not found
        return "proceed";
    }
}

function validate_user_phone($contact)
{
    global $conn;
    $sql = "SELECT COUNT(*) AS count FROM users WHERE contact = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $contact);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Check if the email exists
    if ($count > 0) {
        // Email exists
        return "exists";
    } else {
        // Email not found
        return "proceed";
    }
}

function get_user($user_id)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}

// UPDATE USER BIO
function updateUserProfile($user_id, $firstname, $lastname)
{
    global $conn;

    // Prepare the SQL statement
    $sql = "UPDATE users SET firstname = ?, lastname = ? WHERE user_id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ssi", $firstname, $lastname, $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            $stmt->close();
            return "Profile updated successfully.";
        } else {
            $stmt->close();
            return "Error updating profile: " . $stmt->error;
        }
    } else {
        return "Error preparing the statement: " . $conn->error;
    }
}

function updateUserPassword($user_id, $old_password, $new_password)
{
    global $conn;

    // Prepare and execute a SELECT statement to fetch the user's password
    $sql_select = "SELECT `password` FROM `users` WHERE `user_id` = ?";
    if ($stmt_select = $conn->prepare($sql_select)) {
        $stmt_select->bind_param("i", $user_id);
        $stmt_select->execute();
        $stmt_select->bind_result($dbpass);
        $stmt_select->fetch();
        $stmt_select->close();

        // Check if the old password matches the stored password
        if (password_verify($old_password, $dbpass)) {
            // Prepare and execute an UPDATE statement to update the password
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql_update = "UPDATE `users` SET `password` = ? WHERE `user_id` = ?";
            if ($stmt_update = $conn->prepare($sql_update)) {
                $stmt_update->bind_param("si", $hashed_new_password, $user_id);
                if ($stmt_update->execute()) {
                    $stmt_update->close();
                    return "Your password has been changed successfully";
                } else {
                    $stmt_update->close();
                    return "Error, something went wrong";
                }
            } else {
                return "Error preparing update statement: " . $conn->error;
            }
        } else {
            return "Invalid current password!";
        }
    } else {
        return "Error preparing select statement: " . $conn->error;
    }
}

function updateUsername($username, $user_id)
{
    global $conn;

    // Prepare the SQL statement
    $sql = "UPDATE users SET username = ? WHERE user_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("si", $username, $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            $stmt->close();
            return "Username updated successfully";
        } else {
            $stmt->close();
            return "error: " . $stmt->error;
        }
    } else {
        return "error: " . $conn->error;
    }
}

// get user video
function getUserVideo($user_id)
{
    global $conn;
    $sql = "SELECT * FROM videos WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $videos = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            $videos[] = $row;
        }
        return $videos;
    } else {
        return null;
    }
}

function getSpecificVideo($user_id, $video_id)
{
    global $conn;
    $sql = "SELECT * FROM videos WHERE user_id = ? AND video_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $video_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

function updateVisbility($visibility, $video_id)
{
    global $conn;
    $sql = "UPDATE videos SET visibility = ? WHERE video_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("si", $visibility, $video_id);

        // Execute the statement
        if ($stmt->execute()) {
            $stmt->close();
            return "Visibility status changed successfully";
        } else {
            $stmt->close();
            return "error: " . $stmt->error;
        }
    } else {
        return "error: " . $conn->error;
    }
}

function getComments($video_id)
{
    global $conn;
    $sql = "SELECT c.*, u.firstname, u.lastname, u.profile_picture FROM comments AS c JOIN users AS u ON c.user_id = u.user_id WHERE video_id = ? ORDER BY comment_id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $video_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $comments = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            $comments[] = $row;
        }
        return $comments;
    } else {
        return null;
    }
}

function getVideos() {
    global $conn;
    $sql = "SELECT v.*, u.firstname, u.lastname, u.profile_picture 
            FROM videos AS v 
            JOIN users AS u ON v.user_id = u.user_id";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // Handle error with prepare statement
        return [];
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $videos = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $videos[] = $row;
        }
    }
    $stmt->close();
    return $videos;
}

function getAllComments() {
    global $conn;
    $sql = "SELECT c.*, u.firstname, u.lastname, u.profile_picture 
            FROM comments AS c 
            JOIN users AS u ON c.user_id = u.user_id 
            ORDER BY c.comment_id DESC";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        // Handle error with prepare statement
        return [];
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $comments = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
    }

    $stmt->close();
    return $comments;
}


