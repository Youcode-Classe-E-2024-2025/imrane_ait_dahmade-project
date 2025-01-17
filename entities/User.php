<?php

class User
{
    private $id;
    private string $name;
    private string $email;
    private string $password;
    private string $type;
    public function __construct($name, $email, $password, $type)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getid():int {
        return $this->id;
    }
    public function setId($id):void{
        $this->id = $id;
    }

    public function getemail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function getType(): string{
        return $this->type;
    }
  
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setemail($email): void
    {
        $this->email = $email;
    }

    public function setpassword($password): void
    {
        $this->password = $password;
    }
}
?>