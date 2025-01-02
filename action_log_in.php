<?php 

require_once "./class_user.php";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $EMAIL = $_POST['email'];
    $password = $_POST['password'];

    $user = new user(null,null,$EMAIL,$password,null,null);
    $user ->log_in_user($EMAIL,$password);
}