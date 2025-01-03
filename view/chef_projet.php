<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef de Projet - Gestion des Tâches et Projets</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        nav , button{
            background-color:rgb(103, 171, 121);
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="navbar navbar-expand-lg navbar-light  text-white py-3">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Chef de Projet</a>
            <button class="btn btn-light" onclick="toggleTaskPopup()">Ajouter une Tâche</button>
            <button class="btn btn-light" onclick="toggleProjectForm()">Ajouter un Projet</button>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Section Projets -->
        <div id="projectSection">
            <h2 class="text-lg font-bold">Projets</h2>
            <div id="projectList" class="mt-3 mb-4">
                <!-- Les projets seront affichés ici -->
            </div>
            <div class="d-none" id="projectForm">
                <div class="card p-3">
                    <h3>Ajouter un Nouveau Projet</h3>
                    <form id="addProjectForm">
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Nom du Projet:</label>
                            <input type="text" id="projectName" name="projectName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="projectDescription" class="form-label">Description:</label>
                            <textarea id="projectDescription" name="projectDescription" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Section Tâches -->
        <div id="taskSection">
            <h2 class="text-lg font-bold">Tâches</h2>
            <div id="taskList" class="mt-3 mb-4">
                <!-- Les tâches seront affichées ici -->
            </div>
        </div>

        <!-- Popup Form Tâches -->
        <div class="modal fade" id="taskPopup" tabindex="-1" aria-labelledby="taskPopupLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="taskPopupLabel">Ajouter une Nouvelle Tâche</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addTaskForm">
                            <div class="mb-3">
                                <label for="taskName" class="form-label">Nom de la Tâche:</label>
                                <input type="text" id="taskName" name="taskName" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="taskDescription" class="form-label">Description:</label>
                                <textarea id="taskDescription" name="taskDescription" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="assignedTo" class="form-label">Assigner à:</label>
                                <select id="assignedTo" name="assignedTo" class="form-select">
                                    <option value="">Choisir un membre de l'équipe</option>
                                    <option value="member1">Membre 1</option>
                                    <option value="member2">Membre 2</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleProjectForm() {
            const form = document.getElementById('projectForm');
            form.classList.toggle('d-none');
        }

        document.getElementById('addTaskForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const taskName = document.getElementById('taskName').value;
            const taskDescription = document.getElementById('taskDescription').value;
            const assignedTo = document.getElementById('assignedTo').value;

            if (taskName && taskDescription && assignedTo) {
                const taskList = document.getElementById('taskList');

                const taskCard = document.createElement('div');
                taskCard.classList.add('card', 'p-3', 'mb-3');
                taskCard.innerHTML = `
                    <h5>${taskName}</h5>
                    <p>${taskDescription}</p>
                    <p><strong>Assigné à:</strong> ${assignedTo}</p>
                `;

                taskList.appendChild(taskCard);
                const modal = bootstrap.Modal.getInstance(document.getElementById('taskPopup'));
                modal.hide();
                document.getElementById('addTaskForm').reset();
            }
        });

        function toggleTaskPopup() {
            const modal = new bootstrap.Modal(document.getElementById('taskPopup'));
            modal.show();
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
