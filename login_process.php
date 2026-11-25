<?php
session_start();
$user = $_POST['username'];
$pass = $_POST['password'];

$valid_user = "admin";
$valid_pass = "admin123";

if($user === $valid_user && $pass === $valid_pass){
    $_SESSION['logged_in'] = true;
    header("Location: admin.php");
    exit;
}else{
    header("Location: adminlogin.php?error=1");
    exit;
}
?>