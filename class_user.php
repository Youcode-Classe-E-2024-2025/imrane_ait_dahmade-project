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


   }





}






