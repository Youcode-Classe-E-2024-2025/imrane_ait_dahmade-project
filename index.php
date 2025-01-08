<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/__connction.php';

# entities
require_once __DIR__ . '/entities/User.php';
require_once __DIR__ . '/enums/TypeUser.php';

require_once __DIR__ . '/model/UserModel.php';
require_once __DIR__ . '/controller/AuthnticationController.php';

// REGISTRE AND LOGIN
$register = new AuthenticationController(new UserModel());
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['register'])){
    $user = [
            'name' => $_POST['nom'],
            'password' => $_POST['password'],
            'email' => $_POST['email'],
            'type_user' => $_POST['type_user']
    
        ];
    $register->register($user);

    header('Location:http://localhost/imrane_ait_dahmade-project/view/page_login.php');
    }
    
    if (isset($_POST['login'])) {
      
        $user = [
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        $register->login($user);
    }


    // if (isset($_POST['update'])) {
    //     $projectId = $_POST['projectId'];
    //     $projectName = $_POST['projectName'];
    //     $projectDescription = $_POST['projectDescription'];
    
    //     $projet = new Projet();
    //     $projet->setId($projectId);
    //     $projet->setNom($projectName);
    //     $projet->setDescription($projectDescription);
    
    //     $projetModel = new ProjetModel();
    //     $projetModel->modifierProjet($projet);
    
    // }
}

//************** */

?>