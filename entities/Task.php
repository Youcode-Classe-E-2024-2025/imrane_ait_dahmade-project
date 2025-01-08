<?php

class Task {
    private int $id;
    private string $name;
    private string $description;
    private Typetask $type;
    private Employee $assignedTo;
    private array $tags = [];
    private Status $status;

    // Constructor
    public function __construct(
        string $name,
        string $description,
        Typetask $type,
        Employee $assignedTo,
        array $tags,
        Status $status
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->assignedTo = $assignedTo;
        $this->tags = $tags;
        $this->status = $status;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getType(): Typetask {
        return $this->type;
    }

    public function getAssignedTo(): Employee {
        return $this->assignedTo;
    }

    public function getTags(): array {
        return $this->tags;
    }

    public function getStatus(): Status {
        return $this->status;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setType(Typetask $type): void {
        $this->type = $type;
    }

    public function setAssignedTo(Employee $assignedTo): void {
        $this->assignedTo = $assignedTo;
    }

    public function setTags(array $tags): void {
        $this->tags = $tags;
    }

    public function setStatus(Status $status): void {
        $this->status = $status;
    }

    public function addTag(Tag $tag): void {
        $this->tags[] = $tag;
    }
}

?>
