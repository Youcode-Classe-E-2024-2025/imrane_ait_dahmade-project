<?php

class AuthenticationController
{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    // Méthode pour gérer l'inscription
    public function register(array $requestData): void
    {
        try {

            if (empty($requestData['name']) || empty($requestData['email']) || empty($requestData['password'])) {
                echo "All fields are required.";
                return;
            }

            // $usertype = TypeUser::from($requestData['type_user']);
            $user = new User(

                $requestData['name'],
                $requestData['email'],
                $requestData['password'],
                $requestData['type_user']
            );


            if ($this->userModel->register($user)) {
                echo "Registration successful!";
            } else {
                echo "Registration failed. Please try again.";
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }


    public function login(array $requestData): void
    {
        session_start();
    
        try {
            if (empty($requestData['email']) || empty($requestData['password'])) {
                echo "Email and password are required.";
                return;
            }
    
            $user = $this->userModel->login($requestData['email'], $requestData['password']);
    
            if ($user) {
                // Stocker les informations utilisateur dans la session
                $_SESSION['user_name'] = $user->getName();
                $_SESSION['user_type'] = $user->gettype();
    
                echo "Login successful! Welcome, " . $user->getName();
    
                if ($user->gettype() === 'chef_de_projet') {
                    header('Location: ./view/chef_projet.php?name=' . $user->getName());
                    exit();
                } else {
                    header('Location: ./view/page_employe.php?name=' . $user->getName());
                    exit();
                }
            } else {
                echo "Invalid email or password.";
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }
}
