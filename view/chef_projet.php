<?php
// Inclure les fichiers nécessaires
require_once __DIR__ . '/../model/ProjetModel.php';
require_once __DIR__ . '/../controller/projetController.php';

// Démarrer la session pour accéder aux informations utilisateur
session_start();

if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_type'])) {
    echo "Vous devez être connecté pour voir cette page.";
    exit();
}

// Récupérer le nom de l'utilisateur connecté
$nomUtilisateur = $_SESSION['user_name'];

// Instancier les modèles et contrôleurs nécessaires
$projetModel = new ProjetModel();
$projetController = new projetController($projetModel);

// Obtenir les projets de l'utilisateur
$projets = $projetController->afficherProjets($nomUtilisateur);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef de Projet - Gestion des Projets</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        nav, button {
            background-color: rgb(103, 171, 121);
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="navbar navbar-expand-lg navbar-light text-white py-3">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Chef de Projet : <?php echo htmlspecialchars($nomUtilisateur) ?></a>
            <button class="btn btn-primary bg-green-700 hover:bg-green-400 border-none" data-bs-toggle="modal" data-bs-target="#projectModal">Ajouter un Nouveau Projet</button>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Section Projets -->
        <div id="projectSection">
            <h2 class="text-lg font-bold mb-3">Projets</h2>

            <!-- Liste des projets existants -->
            <div id="projectList" class="mb-4">
                <?php if (!empty($projets)): ?>
                    <?php foreach ($projets as $projet): ?>
                        <div class="card p-3 mb-3">
                            <h5 class="mb-2"><?php echo htmlspecialchars($projet['nom']); ?></h5>
                            <p><?php echo htmlspecialchars($projet['description']); ?></p>
                            <p>Date de création : <?php echo htmlspecialchars($projet['date_creation']); ?></p>
                            <p>Date limite : <?php echo htmlspecialchars($projet['date_deadline']); ?></p>
                            <button class="btn btn-sm btn-secondary " onclick="viewProjectDetails(
                                '<?php echo htmlspecialchars($projet['nom']); ?>',
                                '<?php echo htmlspecialchars($projet['description']); ?>'
                            )">Voir les détails</button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun projet trouvé pour le moment.</p>
                <?php endif; ?>
            </div>

      
        </div>
    </div>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectModalLabel">Ajouter un Nouveau Projet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProjectForm" action="../controller/projetController.php" method="POST">
                        <!-- Nom du Projet -->
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Nom du Projet :</label>
                            <input type="text" id="projectName" name="projectName" class="form-control" required>
                        </div>

                        <!-- Description du Projet -->
                        <div class="mb-3">
                            <label for="projectDescription" class="form-label">Description :</label>
                            <textarea id="projectDescription" name="projectDescription" class="form-control" required></textarea>
                        </div>

                        <!-- Date de Création -->
                        <div class="mb-3">
                            <label for="dateCreation" class="form-label">Date de Création :</label>
                            <input type="date" id="dateCreation" name="dateCreation" class="form-control" required>
                        </div>

                        <!-- Date Limite -->
                        <div class="mb-3">
                            <label for="dateDeadline" class="form-label">Date Limite :</label>
                            <input type="date" id="dateDeadline" name="dateDeadline" class="form-control" required>
                        </div>

                        <!-- Bouton soumettre -->
                        <button type="submit" name="ajouterProjet" class="btn btn-success">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        // Afficher les détails d'un projet
        function viewProjectDetails(name, description) {
            alert(`Nom du Projet : ${name}\nDescription : ${description}`);
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
