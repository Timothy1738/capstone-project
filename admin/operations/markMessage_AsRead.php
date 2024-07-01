<?php
include "../../backend/connection.php";
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message_id = $_POST['message_id'];
}
?>