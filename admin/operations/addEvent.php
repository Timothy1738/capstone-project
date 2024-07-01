<?php
include "../../backend/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_name = $_POST['name'];
    $description = $_POST['description'];
    $contact_1 = $_POST['contact_1'];
    $contact_2 = $_POST['contact_2'];
    $url = $_POST['link'];
    if (strpos($url, 'http://') !== 0 && strpos($url, 'https://') !== 0) {
        $url = 'http://' . $url; // or 'https://' depending on your requirement
    }

    $date = $_POST['date'];

    $unique_name = uniqid() . '-' . basename($_FILES["file"]["name"]);
    $target_dir = "../../dbimages/";
    $target_file = $target_dir . $unique_name;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO `events` (`event_name`, `description`, `venue`, `contact_two`, `links`, `event_date`, `thumbnail`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $event_name, $description, $contact_1, $contact_2, $url, $date, $unique_name);

        if ($stmt->execute()) {
            header("Location: ../events.php?success=Event Added successfully!");
            exit();
        } else {
            header("Location: ../events.php?error=Something went wrong! Failed to add event!");
            exit();
        }
        $stmt->close();
    } else {
        header("Location: ../events.php?error=Error moving file");
        exit();
    }
} else {
    header("Location: ../events.php?error=Invalid Access Method");
    exit();
}

$conn->close();
?>
