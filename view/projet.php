<?php
  include_once "../__connction.php";
  include_once "../class_projet.php";
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet - Gestion des Tâches</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-success text-white py-3">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Projet: Nom du Projet</a>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Informations du Projet -->
        <div class="card mb-4">
            <div class="card-body">
            <?php
            $projet = new Projet() ;
            $projet->afficherProjets($conn);
            echo $projet->afficherProjets($conn);
            
            ?>
            </div>
        </div>

        <!-- Section Tâches -->
        <div id="taskSection">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="text-lg font-bold">Tâches</h2>
                <button class="btn btn-primary" onclick="toggleTaskPopup()">Ajouter une Tâche</button>
            </div>
            <div id="taskList" class="mt-3 mb-4">
                <!-- Les tâches seront affichées ici -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tâche 1</h5>
                        <p class="card-text">Description de la tâche 1.</p>
                        <p><strong>Assigné à:</strong> Membre 1</p>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-warning btn-sm me-2" onclick="editTask(this)">Modifier</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteTask(this)">Supprimer</button>
                        </div>
                    </div>
                </div>
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
                        <form id="taskForm">
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
        function toggleTaskPopup() {
            const modal = new bootstrap.Modal(document.getElementById('taskPopup'));
            modal.show();
        }

        function deleteTask(button) {
            const taskCard = button.closest('.card');
            taskCard.remove();
        }

        function editTask(button) {
            const taskCard = button.closest('.card');
            const taskName = taskCard.querySelector('.card-title').textContent;
            const taskDescription = taskCard.querySelector('.card-text').textContent;
            const assignedTo = taskCard.querySelector('strong').textContent.split(': ')[1];

            document.getElementById('taskName').value = taskName;
            document.getElementById('taskDescription').value = taskDescription;
            document.getElementById('assignedTo').value = assignedTo;

            toggleTaskPopup();
        }

        document.getElementById('taskForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const taskName = document.getElementById('taskName').value;
            const taskDescription = document.getElementById('taskDescription').value;
            const assignedTo = document.getElementById('assignedTo').value;

            if (taskName && taskDescription && assignedTo) {
                const taskList = document.getElementById('taskList');

                const taskCard = document.createElement('div');
                taskCard.classList.add('card', 'mb-3');
                taskCard.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title">${taskName}</h5>
                        <p class="card-text">${taskDescription}</p>
                        <p><strong>Assigné à:</strong> ${assignedTo}</p>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-warning btn-sm me-2" onclick="editTask(this)">Modifier</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteTask(this)">Supprimer</button>
                        </div>
                    </div>
                `;

                taskList.appendChild(taskCard);
                const modal = bootstrap.Modal.getInstance(document.getElementById('taskPopup'));
                modal.hide();
                document.getElementById('taskForm').reset();
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
