<?php

include_once '../config/__connction.php';

class ProjetModel{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = DataBaseConnection::getInstance()->getConnection();
    }

    public function ajouterProjet(Projet $projet) {
        $requet = "INSERT INTO projets (nom, description, date_creation, date_deadline, nomChefProjet) VALUES (:NOM, :description, :date_creation, :date_deadline, :nameChefProjet);";
        $stmt = $this->conn->prepare($requet);
        return $stmt->execute([
            ':NOM' => $projet->getNom(),
            ':description' => $projet->getDescription(),
            ':date_creation' => $projet->getDateCreation(),
            ':date_deadline' => $projet->getDeadline(),
            ':nameChefProjet' => $projet->getChef()
        ]);
    }
    public function affichageProjet(){

    }

    public function modifierProjet(Projet $projet){
        $requet = "UPDATE projets SET nom = :nom , description = :description ,date_creation = :date_creation ,date_deadline = :date_deadline where id_projet = :id ";
        $stmt = $this->conn->prepare($requet);
        return $stmt ->execute([      
            ':nom' => $projet->getNom(),
            ':description' => $projet->getDescription(),
            ':date_creation' => $projet->getDateCreation(),
            ':date_deadline' => $projet->getDeadline(),
            ':id_projet' => $projet->getId()
        ]);
    }
    public function suprimerProjet(int $id){
        $requet = "DELETE FROM projets where id_projet = :id ;";
        $stmt= $this->conn->prepare($requet);
       return $stmt->execute([
            ':id' => $id,
        ]
       );
    }
    public function getTousLesProjets( $NomChef): array {
        $query = "SELECT * FROM projets WHERE NomChefProjet = :Chef";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Chef', $NomChef, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }
    

}

?>