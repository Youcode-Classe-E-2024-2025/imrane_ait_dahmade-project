<?php
class UserModel{

    private PDO $conn ;
    public function __construct()
    {
        $this->conn = DataBaseConnection::getInstance()->getConnection();
    }

    public function register(User $user)  {
        try {
            $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $this->conn->prepare($query);

            $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);

            return $stmt->execute([
                ':name' => $user->getName(),
                ':email' => $user->getEmail(),
                ':password' => $hashedPassword,
            ]);
        } catch (PDOException $e) {
            error_log('Registration failed: ' . $e->getMessage());
            return false;
        }
    }

    public function login(string $email, string $password): ?User {
        try {
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':email' => $email]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return new User(
                    $user['id'],
                    $user['name'],
                    $user['email'],
                    $user['password']
                );
            }
        } catch (PDOException $e) {
            error_log('Login failed: ' . $e->getMessage());
        }

        return null;
    }


}

?>