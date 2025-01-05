<?php
class User{
    private $id;
    private string $name;
    private string $email;
    private string $password;

     public function __construct($name,$email,$password)
     {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
     }
     
    public function getName(): string {
        return $this->name;
    }

    public function getemail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setName($name): void{
        $this->name = $name;
    }

    public function setemail($email): void{
        $this->email = $email;
    }

    public function setpassword($password): void{
        $this->password = $password;
    }
}
?>