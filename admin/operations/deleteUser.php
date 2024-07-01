<?php
include "../../backend/connection.php";
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $query = "DELETE FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("location: ../users.php?success=User deleted successfully!");
    } else {
        header("location: ../users.php?error=Something went wrong! Failed to delete user!");
    }
} else {
    header("location: ../users.php?error=Invalid Access Method");
}
