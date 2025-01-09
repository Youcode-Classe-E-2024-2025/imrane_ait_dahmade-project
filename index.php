<?php


require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/__connction.php';

# entities
require_once __DIR__ . '/entities/User.php';
require_once __DIR__ . '/enums/TypeUser.php';
require_once __DIR__ . '/entities/Projet.php';
require_once __DIR__ . '/enums/TypeProjet.php';

require_once __DIR__ . '/model/UserModel.php';
require_once __DIR__ . '/controller/AuthnticationController.php';
require_once __DIR__ . './model/ProjetModel.php';
require_once __DIR__ . './controller/projetController.php';

// REGISTRE AND LOGIN
$register = new AuthenticationController(new UserModel());
$projetController = new projetController(new ProjetModel());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
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

    if (isset($_POST["ajouterProjet"])) {
        $dateCreation = new DateTime($_POST['dateCreation']);
        $dateDeadline = new DateTime($_POST['dateDeadline']);
        $type = match ($_POST['type']) {
            'public' => TypeProjet::PUBLIC,
            'prive' => TypeProjet::PRIVEE,
            default => TypeProjet::PUBLIC,
        };

        $project = new Projet(
            $_POST['projectName'],
            $_POST['projectDescription'],
            $dateCreation,
            $dateDeadline,
            $_POST['chefProjet'],
            $type
        );

        if ($projetController->ajouterProjet($project)) {
            header('Location: ./view/chef_projet.php');
        } else {
            throw ('error');
        }
    }
    if(isset($_POST['SuprimerProjet'])){
        $idProjet = $_POST['id_projet'];
        
        if($projetController->suprimerProjet($idProjet)) {
            header('Location: ./view/chef_projet.php');
        }
    }
    
      
}

//************** */
