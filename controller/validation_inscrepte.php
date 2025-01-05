<?php
include_once "../class_user.php";

if($_SERVER['REQUEST_METHOD']=== 'POST'){
  $NOM = $_POST['nom'];
  $id = $_POST['id_user'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $date_naissance = $_POST['date_de_naisssance'];
  $type_user = $_POST['type_user'];

  $user = new user($id,$NOM,$email,$password,$date_naissance,$type_user);
  $user->ajouter_user($id,$NOM,$email,$password,$date_naissance,$type_user);
  
}