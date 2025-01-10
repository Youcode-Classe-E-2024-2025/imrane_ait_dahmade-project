<?php
// Vérification de la présence de l'ID du projet
if (isset($_GET['id'])) {
    $idProjet = $_GET['id'];
} else {
    die("ID du projet non défini.");
}

// Inclusion des fichiers nécessaires
require_once __DIR__ . '/../model/ProjetModel.php';
require_once __DIR__ . '/../controller/projetController.php';
require_once __DIR__ . '/../model/TaskModel.php';
require_once __DIR__ . '/../controller/tacheController.php';

$projetController = new projetController(new ProjetModel());
$res = $projetController->afficherProjet($idProjet);

$tacheController = new tacheController(new $taskModel);
$restache = $tacheController->afficherTaches($idProjet);
if (!$res) {
    die("Projet introuvable.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Projet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        nav,
        button {
            background-color: rgb(103, 171, 121);
        }
    </style>
</head>

<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light text-white py-3">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Gestion des Projets</a>
            <button class="btn btn-primary bg-green-700 hover:bg-green-400 border-none" data-bs-toggle="modal" data-bs-target="#ajouterTacheModal">
                Ajouter une tâche
            </button>
        </div>
    </nav>

    <!-- Informations du projet -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h2 id="project-name"><?php echo htmlspecialchars($res['nom']); ?></h2>
        </div>
        <div class="card-body">
            <p><strong>Description :</strong> <?php echo htmlspecialchars($res['description']); ?></p>
            <p><strong>Date de création :</strong> <?php echo htmlspecialchars($res['date_creation']); ?></p>
            <p><strong>Date d'échéance :</strong> <?php echo htmlspecialchars($res['date_deadline']); ?></p>
            <p><strong>Chef de projet :</strong> <?php echo htmlspecialchars($res['nomChefProjet']); ?></p>
            <p><strong>Type de projet :</strong> <?php echo htmlspecialchars($res['TypeProjet']); ?></p>
        </div>
    </div>

    <!-- Liste des tâches assignées -->
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3>Tâches assignées</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nom de la Tâche</th>
                        <th>Description</th>
                        <th>Statut</th>
                        <th>categorie</th>
                        <th>assignée a</th>
                        <th>tag</th>
                        
                    </tr>
                </thead>
                <tbody id="tasks-list">
                    
                    <tr><?php  echo htmlspecialchars($res)  ?></tr>
                    
                  
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modale d'ajout de tâche -->
    <div class="modal fade" id="ajouterTacheModal" tabindex="-1" aria-labelledby="ajouterTacheModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-blue-500 text-white">
                    <h5 class="modal-title" id="ajouterTacheModalLabel">Ajouter une Tâche</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="ajouter_tache.php" method="POST" class="p-4">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la tâche</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="date_deadline" class="form-label">Date limite</label>
                            <input type="date" class="form-control" id="date_deadline" name="date_deadline">
                        </div>
                        <div class="mb-3">
                            <label for="id_assigné" class="form-label">Assigné à</label>
                            <select class="form-select" id="id_assigné" name="id_assigné" required>
                                <option value="">Sélectionner un utilisateur</option>
                                <?php foreach ($projetController->getUsers() as $user) : ?>
                                    <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['nom']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_tag" class="form-label">Tag</label>
                            <select class="form-select" id="id_tag" name="id_tag">
                                <option value="">Sélectionner un tag</option>
                                <?php foreach ($projetController->getTags() as $tag) : ?>
                                    <option value="<?php echo $tag['id']; ?>"><?php echo htmlspecialchars($tag['nom']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_categorie" class="form-label">Catégorie</label>
                            <select class="form-select" id="id_categorie" name="id_categorie">
                                <option value="">Sélectionner une catégorie</option>
                                <?php foreach ($projetController->getCategories() as $categorie) : ?>
                                    <option value="<?php echo $categorie['id']; ?>"><?php echo htmlspecialchars($categorie['nom']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
