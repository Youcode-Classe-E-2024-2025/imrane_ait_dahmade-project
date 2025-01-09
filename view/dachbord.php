
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tableau de Bord - Statistiques</h1>
        
        <!-- Bouton pour ouvrir la popup -->
        <div class="text-center mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#statsModal">
                Voir les Statistiques
            </button>
        </div>
        
        <!-- Contenu principal -->
        <div class="row text-center">
            <p>Ce tableau de bord contient un résumé des projets et des tâches. Cliquez sur le bouton ci-dessus pour voir les graphiques dans une popup.</p>
        </div>
    </div>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="statsModal" tabindex="-1" aria-labelledby="statsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statsModalLabel">Statistiques Détaillées</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Graphiques -->
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="tasksChart"></canvas>
                        </div>
                        <div class="col-md-6">
                            <canvas id="projectsChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Données pour le graphique des tâches
        const tasksCtx = document.getElementById('tasksChart').getContext('2d');
        new Chart(tasksCtx, {
            type: 'pie',
            data: {
                labels: ['Terminées', 'En cours', 'En retard'],
                datasets: [{
                    label: 'Tâches',
                    data: [78, 35, 12],
                    backgroundColor: ['#28a745', '#007bff', '#dc3545'],
                }]
            }
        });

    </script>

