<?php
require_once __DIR__ . '/config/__connction.php';
require_once __DIR__ . '/model/User.php';
require_once __DIR__ . '/controller/AuthnticationController.php';

$db = new DataBaseConnection();
$db->getConnection();

$usermodel = new UserModel();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
if($_POST['register']){
   $user = [
        'nom' => $_POST['nom'],
        'password' => $_POST['password'],
        'email' => $_POST['email'],
        'type_user' =>$_POST['type_user']
    ];
$register = new AuthenticationController($usermodel);
$register->register($user);


}

}

?>