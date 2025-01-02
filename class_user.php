<?php 


class user {
   public $id_user ;
   public $nom ;
   public $email ;
   public $password ;
   public $date_de_naissance ;
   public $type_user ;
  
   public function __construct($id_user,$nom,$email,$password,$date_de_naissance,$type_user)
   {
     $this->id_user = $id_user;
     $this->nom = $nom;
     $this->email = $email;
     $this->password = $password;
     $this->date_de_naissance = $date_de_naissance;
     $this->type_user = $type_user;
   }
   public function ajouter_user($id_user,$nom,$email,$password,$date_de_naissance,$type_user){
    require_once "./__connction.php";

   echo "hello " . $nom ." your id " . $id_user ." your email " . $email . " your " . $password . " happy " . $date_de_naissance . " and your job is " . $type_user;
   $password = password_hash($password,PASSWORD_DEFAULT);
   $requet_add_sql = "INSERT INTO user (id, nom, email, password, date_naissance, type_user) 
   VALUES (:id, :nom, :email, :password, :date_naissance, :type_user);";
$query = $conn->prepare($requet_add_sql);
$query->execute([
':id' => $id_user,
':nom' => $nom, 
':email' => $email,
':password' => $password,
':date_naissance' => $date_de_naissance,
':type_user' => $type_user,
]);
}

public function log_in_user($email, $password) {
    require_once "./__connction.php"; // Ensure the file path is correct

    $requet_select_sql = "SELECT * FROM user WHERE email = :email"; // No quotes around :email

    $query = $conn->prepare($requet_select_sql);
    $query->execute([':email' => $email]); // Bind the email parameter
    $user = $query->fetch(PDO::FETCH_ASSOC); // Fetch the user details
$password =password_hash($password,PASSWORD_DEFAULT);
    if ($user && password_verify($password, $user['password'])) {
        echo "Hello, welcome Mr.";
    } else {
        echo "Incorrect email or password.";
    }
}







}






