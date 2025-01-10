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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        nav,
        button {
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
                            <input type="hidden" name="idProjet" value="<?php echo htmlspecialchars($projet['id_projet']); ?>">
                            <h5 class="mb-2"><?php echo htmlspecialchars($projet['nom']); ?></h5>
                            <p><?php echo htmlspecialchars($projet['description']); ?></p>
                            <p>Date de création : <?php echo htmlspecialchars($projet['date_creation']); ?></p>
                            <p>Date limite : <?php echo htmlspecialchars($projet['date_deadline']); ?></p>
                            <p>type of Project: <?php echo htmlspecialchars($projet['TypeProjet']); ?></p>
                            <div class="flex flex-row gap-4 p-2">
                                <form action="../index.php" method="post">
                                    <!-- Champ caché pour transmettre l'ID du projet -->
                                    <input type="hidden" name="id_projet" value="<?php echo htmlspecialchars($projet['id_projet']); ?>">
                                    <button class="btn btn-primary bg-red-700 hover:bg-red-400 border-none" name="SuprimerProjet" type="submit">
                                        Supprimer le projet
                                    </button>
                                </form>

                                </form>
                                <form action="../index.php" method="post">
                                    <input type="hidden" name="id_projet" value="<?php echo htmlspecialchars($projet['id_projet']); ?>">
                                    <button
                                        type="button"
                                        class="btn btn-primary bg-green-700 hover:bg-green-400 border-none"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modifierProjetModal<?php echo $projet['id_projet']; ?>">
                                        Modifier le projet
                                    </button>
                                </form>
                                <form action="../index.php" method="post">
                                    <input type="hidden" name="id_projet" value="<?php echo htmlspecialchars($projet['id_projet']); ?>">
                                    <button class="btn btn-primary bg-blue-700 hover:bg-blue-400 border-none" name="AfficheProjet">
                                        details de la projet
                                    </button>
                                </form>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun projet trouvé pour le moment.</p>
                <?php endif; ?>
            </div>


        </div>
    </div>

    <div>
        <?php include_once "./dachbord.php" ?>;
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
                    <form id="addProjectForm" action="../index.php" method="POST">
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
                        <div class="mb-3">
                            <select name="type">
                                <option value="public">public</option>
                                <option value="prive">prive</option>
                            </select>
                        </div>
                        <input type="hidden" name="chefProjet" value="<?php echo htmlspecialchars($nomUtilisateur); ?>">
                        <!-- Bouton soumettre -->
                        <button type="submit" name="ajouterProjet" class="btn btn-success">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="modifierProjetModal<?php echo $projet['id_projet']; ?>" tabindex="-1" aria-labelledby="modifierProjetLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifierProjetLabel">Modifier le Projet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulaire de modification -->
                <form action="../index.php" method="POST">
                    <input type="hidden" name="id_projet" value="<?php echo htmlspecialchars($projet['id_projet']); ?>">

                    <!-- Nom du Projet -->
                    <div class="mb-3">
                        <label for="projectName" class="form-label">Nom du Projet :</label>
                        <input 
                            type="text" 
                            id="projectName" 
                            name="projectName" 
                            class="form-control" 
                            value="<?php echo htmlspecialchars($projet['nom']); ?>" 
                            required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="projectDescription" class="form-label">Description :</label>
                        <textarea 
                            id="projectDescription" 
                            name="projectDescription" 
                            class="form-control" 
                            required><?php echo htmlspecialchars($projet['description']); ?></textarea>
                    </div>

                    <!-- Date de Création -->
                    <div class="mb-3">
                        <label for="dateCreation" class="form-label">Date de Création :</label>
                        <input 
                            type="date" 
                            id="dateCreation" 
                            name="dateCreation" 
                            class="form-control" 
                            value="<?php echo htmlspecialchars($projet['date_creation']); ?>" 
                            required>
                    </div>

                    <!-- Date Limite -->
                    <div class="mb-3">
                        <label for="dateDeadline" class="form-label">Date Limite :</label>
                        <input 
                            type="date" 
                            id="dateDeadline" 
                            name="dateDeadline" 
                            class="form-control" 
                            value="<?php echo htmlspecialchars($projet['date_deadline']); ?>" 
                            required>
                    </div>

                    <!-- Type de Projet -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Type de Projet :</label>
                        <select id="type" name="type" class="form-select" required>
                            <option value="public" <?php echo ($projet['type'] === 'public') ? 'selected' : ''; ?>>Public</option>
                            <option value="prive" <?php echo ($projet['type'] === 'prive') ? 'selected' : ''; ?>>Privé</option>
                        </select>
                    </div>

                    <!-- Bouton de soumission -->
                    <button type="submit" name="modifierProjet" class="btn btn-success">Enregistrer les Modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>