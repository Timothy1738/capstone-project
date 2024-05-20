<?php
$servername = "localhost";
$dbname = "Talent_Exhibition_and_Promotion_System";
$username = "talentverse";
$password = "Titan@1738";

$conn = new mysqli($servername, $username, $password, $dbname);

if(mysqli_errno($conn)) {
    die(mysqli_errno($conn));
}