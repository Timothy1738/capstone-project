<?php

require_once "connection.php";

function removeSpaces($string)
{
    return str_replace(' ', '', $string);
}

function validate_user_email($email)
{
    global $conn;
    $role = "";
    $tables = ["admin", "promoter", "users"];
    $user = null;

    foreach ($tables as $table) {
        $query = "SELECT * FROM $table WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $role = $table;
            $user = $result->fetch_assoc();
            break;
        }
    }

    if ($role !== "" && $user !== null) {
        return "exists";
    } else {
        return "proceed";
    }
}

function validate_user_username($username)
{
    global $conn;
    $role = "";
    $tables = ["admin", "promoter", "users"];
    $user = null;

    foreach ($tables as $table) {
        $query = "SELECT * FROM $table WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $role = $table;
            $user = $result->fetch_assoc();
            break;
        }
    }

    if ($role !== "" && $user !== null) {
        return "exists";
    } else {
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
    $role = "";
    $tables = ["admin", "promoter", "users"];
    $user = null;

    foreach ($tables as $table) {
        $query = "SELECT * FROM $table WHERE contact = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $contact);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $role = $table;
            $user = $result->fetch_assoc();
            break;
        }
    }

    if ($role !== "" && $user !== null) {
        return "exists";
    } else {
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

function getOtherUserProfile($newUser)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $newUser);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}

// UPDATE USER BIO
function updateUserProfile($user_id, $about, $firstname, $lastname)
{
    global $conn;

    // Prepare the SQL statement
    $sql = "UPDATE users SET about = ?, firstname = ?, lastname = ? WHERE user_id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("sssi",$about, $firstname, $lastname, $user_id);

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

function getNumberOfVideos($user_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) as video_count FROM videos WHERE user_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($video_count);
        $stmt->fetch();
        $stmt->close();
        return $video_count;
    } else {
        // Handle error with preparing the statement
        return 0;
    }
}

function getNumberofFollowers($followee_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) as follower_count FROM follows WHERE followee_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $followee_id);
        $stmt->execute();
        $stmt->bind_result($followers_count);
        $stmt->fetch();
        $stmt->close();
        return $followers_count;
    } else {
        // Handle error with preparing the statement
        return 0;
    }
}

function getNumberofFollowering($follower_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) as following_count FROM follows WHERE follower_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $follower_id);
        $stmt->execute();
        $stmt->bind_result($following_count);
        $stmt->fetch();
        $stmt->close();
        return $following_count;
    } else {
        // Handle error with preparing the statement
        return 0;
    }
}

function getNumberofVotes($video_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) as vote_count FROM votes WHERE video_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $video_id);
        $stmt->execute();
        $stmt->bind_result($video_count);
        $stmt->fetch();
        $stmt->close();
        return $video_count;
    } else {
        // Handle error with preparing the statement
        return 0;
    }
}

function getNumberofComments($video_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) as comment_count FROM comments WHERE video_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $video_id);
        $stmt->execute();
        $stmt->bind_result($comment_count);
        $stmt->fetch();
        $stmt->close();
        return $comment_count;
    } else {
        // Handle error with preparing the statement
        return 0;
    }
}


function getSpecificVideo($user_id, $video_id)
{
    global $conn;
    $sql = "SELECT v.*, u.lastname, u.firstname, u.profile_picture FROM videos AS 
    v JOIN users AS u ON v.user_id = u.user_id WHERE u.user_id = ? AND v.video_id = ?";
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


function getVideos($user_id)
{
    global $conn;

    $status = "approved";
    $sql = "SELECT v.*, CONCAT(u.firstname, ' ', u.lastname) AS name, u.profile_picture, COALESCE(vote_summary.vote_count, 0) as vote_count
    FROM videos v
    LEFT JOIN users AS u ON v.user_id = u.user_id
    LEFT JOIN (
        SELECT video_id, COUNT(DISTINCT vote_id) as vote_count
        FROM votes
        GROUP BY video_id
    ) as vote_summary ON v.video_id = vote_summary.video_id WHERE v.user_id != ? AND v.status = ?
    ORDER BY vote_count DESC, v.created_at ASC";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("is", $user_id, $status);
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

function getAllComments()
{
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

function checkIfUserFollows($follower_id, $followee_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) as follow_exists 
            FROM follows
            WHERE follower_id = ? AND followee_id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ii", $follower_id, $followee_id);
        $stmt->execute();
        $stmt->bind_result($follow_exists);
        $stmt->fetch();

        $stmt->close();

        return $follow_exists > 0;
    } else {
        return false;
    }
}

function getFollowers($followee_id)
{
    global $conn;

    $sql = "SELECT U.user_id, U.firstname, U.lastname, U.profile_picture
            FROM users U
            JOIN follows F ON U.user_id = F.follower_id
            WHERE F.followee_id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $followee_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $followers = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $followers[] = $row;
            }
        }

        $stmt->close();
        return $followers;
    } else {
        // Handle error with preparing the statement
        return null;
    }
}

function getFollowing($follower_id)
{
    global $conn;

    $sql = "SELECT U.user_id, U.firstname, U.lastname, U.profile_picture
            FROM users U
            JOIN follows F ON U.user_id = F.followee_id
            WHERE F.follower_id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $follower_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $following = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $following[] = $row;
            }
        }

        $stmt->close();
        return $following;
    } else {
        // Handle error with preparing the statement
        return null;
    }
}

function checkIfUserVoted($user_id, $video_id)
{
    global $conn;
    $sql = "SELECT COUNT(*) as vote_exists 
            FROM votes
            WHERE user_id = ? AND video_id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ii", $user_id, $video_id);
        $stmt->execute();
        $stmt->bind_result($vote_exists);
        $stmt->fetch();

        $stmt->close();

        return $vote_exists > 0;
    } else {
        return false;
    }
}

function get_Admins($admin_id)
{
    global $conn;
    $sql = "SELECT a.*, CONCAT(ad.firstname, ' ' ,ad.lastname) AS created_by 
    FROM `admin` AS a 
    LEFT JOIN `admin` AS ad ON a.created_by = ad.admin_id WHERE a.admin_id != ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $admin = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $admin[] = $row;
        }
        return $admin;
    } else {
        return null;
    }
}


function getMessages()
{
    global $conn;
    $sql = "SELECT * FROM contact";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $contact = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $contact[] = $row;
        }
        return $contact;
    } else {
        return null;
    }
}

function getAllUsers()
{
    global $conn;
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    $users = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $users[] = $row;
        }
        return $users;
    } else {
        return null;
    }
}

function newsLettersubs()
{
    global $conn;
    $sql = "SELECT * FROM newsletter";
    $result = mysqli_query($conn, $sql);

    $newsletter = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $newsletter[] = $row;
        }
        return $newsletter;
    } else {
        return null;
    }
}

function PromoterRequests()
{
    global $conn;
    $sql = "SELECT * FROM `promoter_requests`";
    $result = mysqli_query($conn, $sql);

    $promoterRequests = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $promoterRequests[] = $row;
        }
        return $promoterRequests;
    } else {
        return null;
    }
}

function getPromoters()
{
    global $conn;
    $sql = "SELECT p.*, CONCAT(a.firstname, ' ' , a.lastname) AS createdby FROM promoter AS p LEFT JOIN `admin` AS a ON p.created_by = a.admin_id";
    $result = mysqli_query($conn, $sql);

    $promoters = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $promoters[] = $row;
        }
        return $promoters;
    } else {
        return null;
    }
}

function getPromoters_note($promoter_id)
{
    global $conn;
    $sql = "SELECT * FROM promoter WHERE promoter_id != $promoter_id";
    $result = mysqli_query($conn, $sql);

    $promoters = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $promoters[] = $row;
        }
        return $promoters;
    } else {
        return null;
    }
}

function getVideosOrderedByVotes()
{
    global $conn;

    $sql = "SELECT v.*, COALESCE(vote_summary.vote_count, 0) as vote_count
    FROM videos v
    LEFT JOIN (
        SELECT video_id, COUNT(DISTINCT vote_id) as vote_count
        FROM votes
        GROUP BY video_id
    ) as vote_summary ON v.video_id = vote_summary.video_id WHERE v.status = 'approved'
    ORDER BY vote_count DESC, v.created_at ASC";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
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

function getPeopleOrderedByVotes()
{
    global $conn;

    $sql = "SELECT v.video_id, v.user_id, u.firstname, u.lastname, u.profile_picture, u.email, u.contact, COALESCE(vote_summary.vote_count, 0) as vote_count
    FROM videos v
    LEFT JOIN (
        SELECT video_id, COUNT(DISTINCT vote_id) as vote_count
        FROM votes
        GROUP BY video_id
    ) as vote_summary ON v.video_id = vote_summary.video_id
    LEFT JOIN users AS u ON v.user_id = u.user_id WHERE v.status = 'approved'
    ORDER BY vote_count DESC, v.created_at ASC LIMIT 5";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
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

function getMusicCat_orderbyvotes()
{
    global $conn;

    $sql = "SELECT v.video_id, v.user_id, u.firstname, u.lastname, u.profile_picture, u.email, u.contact, COALESCE(vote_summary.vote_count, 0) as vote_count
    FROM videos v
    LEFT JOIN (
        SELECT video_id, COUNT(DISTINCT vote_id) as vote_count
        FROM votes
        GROUP BY video_id
    ) as vote_summary ON v.video_id = vote_summary.video_id
    LEFT JOIN users AS u ON v.user_id = u.user_id WHERE u.category_id = 1 AND v.status = 'approved'
    ORDER BY vote_count DESC, v.created_at ASC LIMIT 5";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
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

function getDanceCat_orderbyvotes()
{
    global $conn;

    $sql = "SELECT v.video_id, v.user_id, u.firstname, u.lastname, u.profile_picture, u.email, u.contact, COALESCE(vote_summary.vote_count, 0) as vote_count
    FROM videos v
    LEFT JOIN (
        SELECT video_id, COUNT(DISTINCT vote_id) as vote_count
        FROM votes
        GROUP BY video_id
    ) as vote_summary ON v.video_id = vote_summary.video_id
    LEFT JOIN users AS u ON v.user_id = u.user_id WHERE u.category_id = 2 AND v.status = 'approved'
    ORDER BY vote_count DESC, v.created_at ASC LIMIT 5";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
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

function getTheatreCat_orderbyvotes()
{
    global $conn;

    $sql = "SELECT v.video_id, v.user_id, u.firstname, u.lastname, u.profile_picture, u.email, u.contact, COALESCE(vote_summary.vote_count, 0) as vote_count
    FROM videos v
    LEFT JOIN (
        SELECT video_id, COUNT(DISTINCT vote_id) as vote_count
        FROM votes
        GROUP BY video_id
    ) as vote_summary ON v.video_id = vote_summary.video_id
    LEFT JOIN users AS u ON v.user_id = u.user_id WHERE u.category_id = 3 AND v.status = 'approved'
    ORDER BY vote_count DESC, v.created_at ASC LIMIT 5";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
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

function getComedyCat_orderbyvotes()
{
    global $conn;

    $sql = "SELECT v.video_id, v.user_id, u.firstname, u.lastname, u.profile_picture, u.email, u.contact, COALESCE(vote_summary.vote_count, 0) as vote_count
    FROM videos v
    LEFT JOIN (
        SELECT video_id, COUNT(DISTINCT vote_id) as vote_count
        FROM votes
        GROUP BY video_id
    ) as vote_summary ON v.video_id = vote_summary.video_id
    LEFT JOIN users AS u ON v.user_id = u.user_id WHERE u.category_id = 4 AND v.status = 'approved'
    ORDER BY vote_count DESC, v.created_at ASC LIMIT 5";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
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

//var_dump(getPeopleOrderedByVotes());


function get_admin($admin_id)
{
    global $conn;
    $sql = "SELECT * FROM `admin` WHERE admin_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}

function get_promoter($promoter_id) {
    global $conn;
    $sql = "SELECT * FROM `promoter` WHERE promoter_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $promoter_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}

function approveVidoes()
{
    global $conn;
    $sql = "SELECT v.user_id, v.video_id, v.talentCategory, v.video_url, v.description, u.profile_picture 
            FROM videos AS v 
            JOIN users AS u ON v.user_id = u.user_id
            WHERE v.status = 'pending'";
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

function approveVideo($video_id)
{
    global $conn;
    $sql = "SELECT v.user_id, v.video_id, v.talentCategory, v.video_url, v.description, v.status, u.profile_picture 
            FROM videos AS v 
            JOIN users AS u ON v.user_id = u.user_id
            WHERE v.video_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // Handle error with prepare statement
        return [];
    }
    $stmt->bind_param("i", $video_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row;
}

function approvalNotification($user_id, $video_id, $type, $tablename, $sender, $is_read)
{
    global $conn;
    $sql = "INSERT INTO `notifications`(`user_id`, `related_id`, `type`, `table_name`, `sender_id`, `is_read`) 
    VALUES ('$user_id', '$video_id', '$type','$tablename','$sender','$is_read')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return "success";
    } else {
        return "error";
    }
}

function getCategoryName($category_id) {
    global $conn;
    $sql = "SELECT talent_Name FROM category WHERE category_id = '$category_id'";
    $mysqli = mysqli_query($conn, $sql);
    if($mysqli) {
        $row = mysqli_fetch_array($mysqli);
        $name = $row['talent_Name'];
        return $name;
    }
}

function approvallogs()
{
    global $conn;
    $sql = "SELECT v.*, u.firstname, u.lastname, CONCAT(ad.firstname, ' ' ,ad.lastname) AS created_by
    FROM videos AS v LEFT JOIN
     `admin` AS ad ON v.approver_id = ad.admin_id
     LEFT JOIN users AS u ON v.user_id = u.user_id WHERE v.status = 'approved' OR v.status = 'denied'";

    $result = mysqli_query($conn, $sql);

    $data = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $data[] = $row;
        }
        return $data;
    } else {
        return null;
    }
}

// var_dump(approvallogs());

function getEvents()
{
    global $conn;
    $sql = "SELECT * FROM `events`";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // Handle error with prepare statement
        return [];
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $events = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }
    $stmt->close();
    return $events;
}

function getSpecificEvent($event_id)
{
    global $conn;
    $sql = "SELECT * FROM `events` WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // Handle error with prepare statement
        return [];
    }
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}

function getNumberOfUsers()
{
    global $conn;
    $sql = "SELECT COUNT(*) as user_count FROM users";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->execute();
        $stmt->bind_result($user_count);
        $stmt->fetch();
        $stmt->close();
        return $user_count;
    } else {
        // Handle error with preparing the statement
        return 0;
    }
}

function getNumberOfPromoters()
{
    global $conn;
    $sql = "SELECT COUNT(*) as promoter_count FROM promoter";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->execute();
        $stmt->bind_result($promoter_count);
        $stmt->fetch();
        $stmt->close();
        return $promoter_count;
    } else {
        // Handle error with preparing the statement
        return 0;
    }
}

function getLikedVideosByUser($user_id) {
    global $conn;
    $sql = "SELECT 
                videos.*
            FROM 
                votes
            JOIN 
                videos ON votes.video_id = videos.video_id
            JOIN 
                users ON votes.user_id = users.user_id
            WHERE 
                users.user_id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return null;
    }

    $liked_videos = [];
    while ($row = $result->fetch_assoc()) {
        $liked_videos[] = $row;
    }

    $stmt->close();
    return $liked_videos;
}

function getNumberofPendingVideos()
{
    global $conn;
    $sql = "SELECT COUNT(*) as video_count FROM videos WHERE status = 'pending'";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->execute();
        $stmt->bind_result($video_count);
        $stmt->fetch();
        $stmt->close();
        return $video_count;
    } else {
        // Handle error with preparing the statement
        return 0;
    }
}

function getNumberOfAllVideos()
{
    global $conn;
    $sql = "SELECT COUNT(*) as video_count FROM videos";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->execute();
        $stmt->bind_result($video_count);
        $stmt->fetch();
        $stmt->close();
        return $video_count;
    } else {
        // Handle error with preparing the statement
        return 0;
    }
}

function myMostVotedVideo($user_id) {
    global $conn;

    $sql = "
        SELECT v.video_id, COALESCE(vote_summary.vote_count, 0) as vote_count
        FROM videos v
        LEFT JOIN (
            SELECT video_id, COUNT(*) as vote_count
            FROM votes
            GROUP BY video_id
        ) as vote_summary ON v.video_id = vote_summary.video_id
        WHERE v.user_id = ?
        ORDER BY vote_count DESC
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $video = null;
    if ($result->num_rows > 0) {
        $video = $result->fetch_assoc();
    }

    $stmt->close();
    return $video;
}

function myMostCommentedVideo($user_id) {
    global $conn;

    $sql = "
        SELECT v.video_url, v.video_id, COALESCE(comment_summary.comment_count, 0) as comment_count
        FROM videos v
        LEFT JOIN (
            SELECT video_id, COUNT(comment_id) as comment_count
            FROM comments
            GROUP BY video_id
        ) as comment_summary ON v.video_id = comment_summary.video_id
        WHERE v.user_id = ?
        ORDER BY comment_count DESC
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $video = null;
    if ($result && $row = $result->fetch_assoc()) {
        $video = $row;
    }

    $stmt->close();
    return $video;
}

function getUserMostVotedVideoPosition($user_id) {
    global $conn;
    
    // Retrieve the position of the specified user based on their most voted video compared to other users
    $sql = "
        SELECT user_id, RANK() OVER(ORDER BY COALESCE(MAX(vote_summary.vote_count), 0) DESC) AS position
        FROM videos v
        LEFT JOIN (
            SELECT video_id, COUNT(vote_id) as vote_count
            FROM votes
            GROUP BY video_id
        ) as vote_summary ON v.video_id = vote_summary.video_id
        WHERE vote_summary.vote_count > 0  -- Filter out videos with no votes
        GROUP BY user_id
    ";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch the position of the specified user
    $position = null;
    while ($row = $result->fetch_assoc()) {
        if ($row['user_id'] == $user_id) {
            $position = $row['position'];
            break;
        }
    }
    
    return $position;
}

function getUsersCreatedToday() {
    global $conn;

    $sql = "SELECT *
        FROM users
        WHERE DATE(created) = CURDATE()";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die('Error preparing the statement: ' . htmlspecialchars($conn->error));
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $users = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    $stmt->close();
    return $users;
}

function get_talentCategory()
{
    global $conn;
    $sql = "SELECT c.*, CONCAT(ad.firstname, ' ' ,ad.lastname) AS created_by FROM `category` AS c LEFT JOIN `admin` AS ad ON c.created_by = ad.admin_id";
    $query_result = mysqli_query($conn, $sql);

    $cateories = [];
    if(mysqli_num_rows($query_result) > 0) {
        while($row = mysqli_fetch_array($query_result)) {
            $cateories[] = $row;
        }
        return $cateories;
    }else {
        return null;
    }
}

function get_categoryBy_id($category_id) {
    global $conn;
    $sql = "SELECT * FROM `category` WHERE category_id = $category_id";
    $result = mysqli_query($conn, $sql);
    if($result) {
        $row = mysqli_fetch_array($result);
        return $row;
    }
}

function insertNotification($receiver_id, $message)
{
    global $conn;
    $sql = "INSERT INTO `notifications`(`user_id`, `message`) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'is', $receiver_id, $message);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        if ($result) {
            return "true";
        } else {
            return "false";
        }
    } else {
        return "false";
    }
}

function getFname($user_id) {
    global $conn;
    $sql = "SELECT firstname FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $fname);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        return $fname;
    } else {
        return null;
    }
}

function countUnreadNotifications($user_id) {
    global $conn;

    // Prepare the SQL statement
    $sql = "SELECT COUNT(*) AS unread_count FROM notifications WHERE user_id = ? AND is_read = 0";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, 'i', $user_id);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Bind the result variables
        mysqli_stmt_bind_result($stmt, $unread_count);

        // Fetch the value
        mysqli_stmt_fetch($stmt);

        // Close the statement
        mysqli_stmt_close($stmt);

        return $unread_count;
    } else {
        return null;
    }
}

function getAllNotifications($user_id) {
    global $conn;

    // Prepare the SQL statement
    $sql = "SELECT * FROM notifications WHERE user_id = ? AND is_read = 0 ORDER BY created_at DESC";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, 'i', $user_id);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Fetch all rows
        $notifications = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $notifications[] = $row;
        }

        // Close the statement
        mysqli_stmt_close($stmt);

        return $notifications;
    } else {
        return null;
    }
}


function getAllReadNotifications($user_id) {
    global $conn;

    // Prepare the SQL statement
    $sql = "SELECT * FROM notifications WHERE user_id = ? AND is_read = 1 ORDER BY created_at DESC";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, 'i', $user_id);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Fetch all rows
        $notifications = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $notifications[] = $row;
        }

        // Close the statement
        mysqli_stmt_close($stmt);

        return $notifications;
    } else {
        return null;
    }
}

function inquiry($email, $name, $username, $subject, $message) {
    // Prepare the SQL query with placeholders
    global $conn;
    $sql = "INSERT INTO inquiry (email, name, username, subject, message) VALUES (?, ?, ?, ?, ?)";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters to the SQL query
        $stmt->bind_param("sssss", $email, $name, $username, $subject, $message);

        // Execute the statement
        if ($stmt->execute()) {
            // Close the statement
            $stmt->close();
            return true; // Return true if the insertion is successful
        } else {
            // Error executing the statement
            $stmt->close();
            return false; // Return false if there was an error
        }
    } else {
        // Error preparing the statement
        return false; // Return false if there was an error
    }
}


function eventsub($email, $contact, $text, $status) {
    // Prepare the SQL query with placeholders
    global $conn;
    $sql = "INSERT INTO event_subs (email, contact, event_info, status) VALUES (?, ?, ?, ?)";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters to the SQL query
        $stmt->bind_param("ssss", $email, $contact, $text, $status);

        // Execute the statement
        if ($stmt->execute()) {
            // Close the statement
            $stmt->close();
            return true; // Return true if the insertion is successful
        } else {
            // Error executing the statement
            $stmt->close();
            return false; // Return false if there was an error
        }
    } else {
        // Error preparing the statement
        return false; // Return false if there was an error
    }
}

function eventsubs() {
    global $conn;
    $sql = "SELECT * FROM `event_subs` ORDER BY `timestamp` DESC";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        // Get the result
        $result = mysqli_stmt_get_result($stmt);
        // Fetch all rows
        $eventsubs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $eventsubs[] = $row;
        }

        // Close the statement
        mysqli_stmt_close($stmt);

        return $eventsubs;
    } else {
        return null;
    }
}

function breakTextAfterWords($text, $wordLimit = 10) {
    // Split the text into an array of words
    $words = explode(' ', $text);
    // Initialize an array to hold chunks of words
    $chunks = [];
    // Loop through the words and create chunks of the specified word limit
    for ($i = 0; $i < count($words); $i += $wordLimit) {
        $chunks[] = implode(' ', array_slice($words, $i, $wordLimit));
    }
    // Join the chunks with a line break
    return implode("<br>\n", $chunks);
}