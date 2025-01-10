<?php

include_once __DIR__ . '/../config/__connction.php';
// require_once '../interfaces/projectInterface.php';
class ProjetModel
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = DataBaseConnection::getInstance()->getConnection();
    }

    public function ajouterProjet(Projet $projet)
    {
        $requet = "INSERT INTO projets (nom, description, date_creation, date_deadline, nomChefProjet ,TypeProjet ) VALUES (:NOM, :description, :date_creation, :date_deadline, :nameChefProjet , :TypeProjet);";
        $stmt = $this->conn->prepare($requet);
        $dateCreation = $projet->getDateCreation()->format('Y-m-d');
        $dateDeadline = $projet->getDeadline()->format('Y-m-d');

        // Récupération des autres propriétés
        $nom = $projet->getNom();
        $description = $projet->getDescription();
        $type = $projet->getType()->value;
        return $stmt->execute([
            ':NOM' => $nom,
            ':description' => $description,
            ':date_creation' => $dateCreation,
            ':date_deadline' => $dateDeadline,
            ':nameChefProjet' => $projet->getChef(),
            ':TypeProjet' => $type
        ]);
    }
    public function affichageProjet(int $id)
    {
        $requet = "SELECT * FROM projets WHERE id_projet = :id;";
        $stmt = $this->conn->prepare($requet);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function modifierProjet(Projet $projet)
    {
        $requet = "UPDATE projets SET nom = :nom , description = :description ,date_creation = :date_creation ,date_deadline = :date_deadline where id_projet = :id ";
        $stmt = $this->conn->prepare($requet);
        return $stmt->execute([
            ':nom' => $projet->getNom(),
            ':description' => $projet->getDescription(),
            ':date_creation' => $projet->getDateCreation(),
            ':date_deadline' => $projet->getDeadline(),
            ':id_projet' => $projet->getId()
        ]);
    }
    public function suprimerProjet(int $id)
    {
        $requet = "DELETE FROM projets where id_projet = :id ;";
        $stmt = $this->conn->prepare($requet);
        return $stmt->execute(
            [
                ':id' => $id,
            ]
        );
    }
    public function getTousLesProjets($NomChef): array
    {
        $query = "SELECT * FROM projets WHERE NomChefProjet = :Chef";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Chef', $NomChef, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }
}

?>
