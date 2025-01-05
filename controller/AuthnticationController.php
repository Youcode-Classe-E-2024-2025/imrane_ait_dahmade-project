<?php

class AuthenticationController {
    private UserModel $userModel;

    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
    }


    public function register(array $requestData): void {
        try {
            if (empty($requestData['name']) || empty($requestData['email']) || empty($requestData['password'])) {
                echo "All fields are required.";
                return;
            }

            $user = new User(
                null,
                $requestData['name'],
                $requestData['email'],
                $requestData['password']
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

    public function login(array $requestData): void {
      
    }
}

?>
