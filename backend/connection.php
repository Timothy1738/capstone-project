<?php
$servername = "localhost";
$dbname = "talent_exhibition_and_promotion_system";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if(mysqli_errno($conn)) {
    die(mysqli_errno($conn));
}