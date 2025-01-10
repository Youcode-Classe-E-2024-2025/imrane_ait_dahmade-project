<?php


include_once __DIR__ . '/../config/__connction.php';
class TaskModel
{

    private  PDO $conn;

    public function __construct()
    {
        $this->conn = DataBaseConnection::getInstance()->getConnection();
    }

    public function AffichagesTasks(int $idProjet)
    {
        $requet = "SELECT * FROM taches where id_projet = :idProjet ;";
        $stmt = $this->conn->prepare($requet);
        $stmt->bindParam(':idProjet', $idProjet, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }
    public function AffichageTask(int $idTask)
    {
        $requet = "SELECT * FROM taches WHERE id_tache = :idTask ;";
        $stmt = $this->conn->prepare($requet);
        $stmt->bindParam(':idTask', $idTask, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function AjouterTask(Task $task)
    {
        $requet = "INSERT INTO taches (nom ,description,date_creation,date_deadline,status,id_assigné,id_tag,id_categorie) VALUES (:nom,:description,:date_creation,:date_deadline,:statut,:id_assigné,:id_tag,:id_categorie);";
        $stmt = $this->conn->prepare($requet);
        $nom = $task->getName();
        $description = $task->getDescription();
        $dateCreation = $task->getDateCreation()->format('Y-m-d');
        $dateDeadline = $task->getDateDeadline()->format('Y-m-d');
        $statut = $task->getStatus();
        $idAssign = $task->getAssignedTo();
        $idcategory = $task->getCategory();
        $idtags = $task->getTags();

        return $stmt->execute([
            ':nom' => $nom,
            ':description' => $description,
            ':date_creation' => $dateCreation,
            ':date_deadline' => $dateDeadline,
            ':statut' => $statut,
            ':id_assigné' => $idAssign,
            ':id_tag' => $idtags,
            ':id_categorie' => $idcategory,
        ]);
    }
    public function suprimerTask(int $id)
    {
        $requet = "DELETE FROM taches WHERE id_tache = :id;";
        $stmt = $this->conn->prepare($requet);
        return $stmt->execute(
            [
                ':id' => $id,
            ]
        );
    }
    
}
