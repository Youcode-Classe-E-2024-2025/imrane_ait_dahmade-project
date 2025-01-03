<!DOCTYPE html>
<html lang="en">
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
            <a class="navbar-brand text-white" href="#">Chef de Projet</a>
            <button class="btn btn-light" onclick="toggleProjectForm()">Ajouter un Projet</button>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Section Projets -->
        <div id="projectSection">
            <h2 class="text-lg font-bold mb-3">Projets</h2>
            <div id="projectList" class="mb-4">
                <!-- Les projets ajoutés seront affichés ici -->
            </div>
            <div class="d-none" id="projectForm">
                <div class="card p-3">
                    <h3 class="mb-3">Ajouter un Nouveau Projet</h3>
                    <form id="addProjectForm">
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Nom du Projet :</label>
                            <input type="text" id="projectName" name="projectName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="projectDescription" class="form-label">Description :</label>
                            <textarea id="projectDescription" name="projectDescription" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Afficher ou masquer le formulaire d'ajout de projet
        function toggleProjectForm() {
            const form = document.getElementById('projectForm');
            form.classList.toggle('d-none');
        }

        // Gestion du formulaire d'ajout de projet
        document.getElementById('addProjectForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const projectName = document.getElementById('projectName').value;
            const projectDescription = document.getElementById('projectDescription').value;

            if (projectName && projectDescription) {
                const projectList = document.getElementById('projectList');

                const projectCard = document.createElement('div');
                projectCard.classList.add('card', 'p-3', 'mb-3');
                projectCard.innerHTML = `
                    <h5 class="mb-2">${projectName}</h5>
                    <p>${projectDescription}</p>
                    <button class="btn btn-sm btn-secondary" onclick="viewProjectDetails('${projectName}', '${projectDescription}')">Voir les détails</button>
                `;

                projectList.appendChild(projectCard);
                toggleProjectForm();
                document.getElementById('addProjectForm').reset();
            }
        });

        // Afficher les détails d'un projet
        function viewProjectDetails(name, description) {
            alert(`Nom du Projet : ${name}\nDescription : ${description}`);
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
