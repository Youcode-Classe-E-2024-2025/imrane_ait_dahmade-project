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
            // Vérification des champs obligatoires
            if (empty($requestData['name']) || empty($requestData['email']) || empty($requestData['password'])) {
                echo "All fields are required.";
                return;
            }

            // Création d'un nouvel utilisateur
            $user = new User(
                null,
                $requestData['name'],
                $requestData['email'],
                $requestData['password']
            );

            // Appel au modèle pour l'enregistrement
            if ($this->userModel->register($user)) {
                echo "Registration successful!";
            } else {
                echo "Registration failed. Please try again.";
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

    // Méthode pour gérer la connexion
    public function login(array $requestData): void
    {
        try {
            // Vérification des champs obligatoires
            if (empty($requestData['email']) || empty($requestData['password'])) {
                echo "Email and password are required.";
                return;
            }

            // Appel au modèle pour la connexion
            $user = $this->userModel->login($requestData['email'], $requestData['password']);

            if ($user) {
                echo "Login successful! Welcome, " . $user->getName();
            } else {
                echo "Invalid email or password.";
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

    // Méthode principale pour gérer l'authentification
    public function handlauth(string $action, array $requestData): void
    {
        if ($action === 'register') {
            $this->register($requestData);
        } elseif ($action === 'login') {
            $this->login($requestData);
        } else {
            echo "Invalid action. Please specify 'register' or 'login'.";
        }
    }
}
