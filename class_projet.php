<?php 
class Projet {
    
    private $nomDeProjet;
    private $description;
    private $dateCreation;
    private $dateDeadline;
    private $nomChef;

    // Constructeur
    public function __construct( $nomDeProjet = null, $description = null, $dateCreation = null, $dateDeadline = null, $nomChef = null) {
   
        $this->nomDeProjet = $nomDeProjet;
        $this->description = $description;
        $this->dateCreation = $dateCreation;
        $this->dateDeadline = $dateDeadline;
        $this->nomChef = $nomChef;
    }

    // Créer un projet
    public function creationProjet($pdo) {
        try {
            $query = "INSERT INTO projet (nom_de_projet, description, date_creation, date_deadline, nom_chef) 
                      VALUES (:nomDeProjet, :description, :dateCreation, :dateDeadline, :nomChef)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nomDeProjet', $this->nomDeProjet);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':dateCreation', $this->dateCreation);
            $stmt->bindParam(':dateDeadline', $this->dateDeadline);
            $stmt->bindParam(':nomChef', $this->nomChef);
            $stmt->execute();
            return "Projet créé avec succès !";
        } catch (PDOException $e) {
            return "Erreur lors de la création du projet : " . $e->getMessage();
        }
    }

    // Modifier un projet
    public function modifierProjet($pdo) {
        try {
            $query = "UPDATE projet SET 
                        nom_de_projet = :nomDeProjet, 
                        description = :description, 
                        date_creation = :dateCreation, 
                        date_deadline = :dateDeadline, 
                        nom_chef = :nomChef 
                      WHERE id_projet = :idProjet";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nomDeProjet', $this->nomDeProjet);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':dateCreation', $this->dateCreation);
            $stmt->bindParam(':dateDeadline', $this->dateDeadline);
            $stmt->bindParam(':nomChef', $this->nomChef);
            $stmt->bindParam(':idProjet', $this->idProjet);
            $stmt->execute();
            return "Projet modifié avec succès !";
        } catch (PDOException $e) {
            return "Erreur lors de la modification du projet : " . $e->getMessage();
        }
    }

    // Supprimer un projet
    public function supprimerProjet($pdo) {
        try {
            $query = "DELETE FROM projet WHERE id_projet = :idProjet";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':idProjet', $this->idProjet);
            $stmt->execute();
            return "Projet supprimé avec succès !";
        } catch (PDOException $e) {
            return "Erreur lors de la suppression du projet : " . $e->getMessage();
        }
    }

    // Afficher tous les projets
    public static function afficherProjets($pdo) {
        try {
            $query = "SELECT * FROM projet";
            $stmt = $pdo->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Erreur lors de la récupération des projets : " . $e->getMessage();
        }
    }
}


?>