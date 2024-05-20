<?php
session_start();
require_once "functions.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = login($email, $password);
    
    if($login == "Wrong Password") {
        header("location: ../login.php?error=Wrong+Password");
    }elseif($login == "Email not Found") {
        header("location: ../login.php?error=Email+not+Found");
    }
}