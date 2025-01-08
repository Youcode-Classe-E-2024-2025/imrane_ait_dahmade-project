<?php

class Projet {
    private int $id;
    private string $nom;
    private string $description;
    private DateTime $dateCreation;
    private DateTime $deadline;
    private ChefProject $chef;
    private array $taches = [];
    private TypeProjet $type;

    // Constructor
    public function __construct(
        string $nom,
        string $description,
        DateTime $dateCreation,
        DateTime $deadline,
        ChefProject $chef,
        TypeProjet $type
    ) {
        $this->nom = $nom;
        $this->description = $description;
        $this->dateCreation = $dateCreation;
        $this->deadline = $deadline;
        $this->chef = $chef;
        $this->type = $type;
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getDateCreation(): DateTime {
        return $this->dateCreation;
    }

    public function getDeadline(): DateTime {
        return $this->deadline;
    }

    public function getChef(): ChefProject {
        return $this->chef;
    }

    public function getTaches(): array {
        return $this->taches;
    }

    public function getType(): TypeProjet {
        return $this->type;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setDateCreation(DateTime $dateCreation): void {
        $this->dateCreation = $dateCreation;
    }

    public function setDeadline(DateTime $deadline): void {
        $this->deadline = $deadline;
    }

    public function setChef(ChefProject $chef): void {
        $this->chef = $chef;
    }

    public function setTaches(array $taches): void {
        $this->taches = $taches;
    }

    public function setType(TypeProjet $type): void {
        $this->type = $type;
    }

    public function addTache(Task $tache): void {
        $this->taches[] = $tache;
    }
}

?>
