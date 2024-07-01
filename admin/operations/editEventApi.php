<?php
include "../../backend/connection.php";
function getEventImg($event_id)
{
    global $conn;
    $sql = "SELECT `thumbnail` FROM `events` WHERE `event_id`";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_array($result);
        $thumbnail = $row['thumbnail'];
        return $thumbnail;
    } else {
        return "error!";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_name = $_POST['name'];
    $venue = $_POST['venue'];
    if (empty($_POST['link'])) {
        $link = "";
    } else {
        $link = $_POST['link'];
        if (strpos($link, 'http://') !== 0 && strpos($link, 'https://') !== 0) {
            $link = 'http://' . $link; // or 'https://' depending on your requirement
        }
    }
    $date = $_POST['date'];
    $contact = $_POST['contact'];
    $description = $_POST['description'];
    $event_id = $_POST['event_id'];
    $old_image = getEventImg($event_id);

    if (isset($_FILES["thumbnail"]["name"]) && !empty($_FILES["thumbnail"]["name"])) {
        $unique_name = uniqid() . '-' . basename($_FILES["thumbnail"]["name"]);
        $target_dir = "../../dbimages/";
        $target_file = $target_dir . $unique_name;

        if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
            $stmt = $conn->prepare("UPDATE `events` SET `event_name`= ?,`description`= ?,`venue`= ?,`contact_two`= ?,`links`= ?,`event_date`= ?,`thumbnail`= ? WHERE `event_id` = ?");
            $stmt->bind_param("sssssssi", $event_name, $description, $venue, $contact, $link, $date, $unique_name, $event_id);
            if ($stmt->execute()) {
                if (!empty($old_image) && file_exists($target_dir . $old_image)) {
                    unlink($target_dir . $old_image);
                }
                header("Location: ../editEvent.php?success=Event Updated successfully!&id=".$event_id);
                exit();
            } else {
                header("Location: ../editEvent.php?error=Something went wrong! Failed to edit event!&id=".$event_id);
                exit();
            }
            $stmt->close();
        } else {
            header("Location: ../editEvent.php?error=Error moving file&id=".$event_id);
            exit();
        }
    } else {
        $stmt = $conn->prepare("UPDATE `events` SET `event_name`= ?,`description`= ?,`venue`= ?,`contact_two`= ?,`links`= ?,`event_date`= ? WHERE `event_id` = ?");
        $stmt->bind_param("ssssssi", $event_name, $description, $venue, $contact, $link, $date, $event_id);
        if ($stmt->execute()) {
            header("Location: ../editEvent.php?success=Event Updated successfully!&id=".$event_id);
            exit();
        } else {
            header("Location: ../editEvent.php?error=Something went wrong! Failed to edit event!&id=".$event_id);
            exit();
        }
        $stmt->close();
    }
} else {
    header("Location: ../editEvent.php?error=Error! Invalid Access Method&id=".$event_id);
    exit();
}
