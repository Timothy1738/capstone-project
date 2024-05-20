NOTIFICATIONS DYNAMICS
--new message
INSERT INTO notifications (user_id, type, related_id, sender_id)
VALUES (2, 'message', 101, 1);  -- user_id 2 receives a message from user_id 1

--vote notification
INSERT INTO notifications (user_id, type, related_id, sender_id)
VALUES (2, 'like', 201, 1);  -- user_id 2's video (video_id 201) is liked by user_id 1

--comment notification
INSERT INTO notifications (user_id, type, related_id, sender_id)
VALUES (2, 'comment', 301, 1);  -- user_id 2's video (video_id 301) is commented on by user_id 1

function markNotificationAsRead($notification_id) {
    global $conn;
    
    // Prepare the SQL statement
    $sql = "UPDATE notifications SET is_read = TRUE WHERE notification_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind the notification ID parameter
        $stmt->bind_param("i", $notification_id);
        
        // Execute the statement
        if ($stmt->execute()) {
            $stmt->close();
            return "Notification marked as read.";
        } else {
            $stmt->close();
            return "Error marking notification as read: " . $stmt->error;
        }
    } else {
        return "Error preparing statement: " . $conn->error;
    }
}


$notification_id = 123; // The ID of the notification to mark as read
$result = markNotificationAsRead($notification_id);
echo $result; // Outputs: Notification marked as read.


function getUnreadNotifications($user_id) {
    global $conn;
    
    // Prepare the SQL statement
    $sql = "SELECT * FROM notifications WHERE user_id = ? AND is_read = FALSE";
    if ($stmt = $conn->prepare($sql)) {
        // Bind the user ID parameter
        $stmt->bind_param("i", $user_id);
        
        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Fetch all notifications
        $notifications = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        
        return $notifications;
    } else {
        return "Error preparing statement: " . $conn->error;
    }
}


$user_id = 1; // The ID of the user
$notifications = getUnreadNotifications($user_id);

foreach ($notifications as $notification) {
    // Display the notification
    echo $notification['type'] . ": " . $notification['related_id'] . " by user " . $notification['sender_id'] . "<br>";
}

