<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="jumbotron bg-green-300 "></div>
    <form action="../controller/validation_inscrepte.php" method="POST" class="w-1/3 justify-self-center shadow-lg space-y-4 p-10 gap-4 rounded-xl">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">CNI</label>
            <input type="name" class="form-control" name="id_user" placeholder="votre id">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">nom_prenom</label>
            <input type="name" name="nom" class="form-control" placeholder="votre_nom">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="col g-3 align-items-center">
            <div class="col-auto">
                <label for="inputPassword6" class="col-form-label">Password</label>
            </div>
            <div class="col-auto">
                <input type="password" name="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
            </div>
            <div class="col-auto">
                <span id="passwordHelpInline" class="form-text">
                    Must be 8-20 characters long.
                </span>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">date de naisssance</label>
            <input type="date" name="date_de_naisssance" class="form-control" id="exampleFormControlInput1" placeholder="date de naisssance">
        </div>
        <select name="type_user" class="form-select" aria-label="Default select example">

            <option value="chef_de_projet">chef_de_projet</option>
            <option value="un_employe"> membre d équipe</option>
        </select>
        <div>
            <button type="submit" class="btn btn-primary bg-green-300">creation_de_compte</button>
        </div>
    </form>

</body>

</html>
<?php

function save_to_file($filename, $content) {
    $filepath = __DIR__ . '/' . $filename;
    file_put_contents($filepath, $content);
    echo "Le fichier '$filename' a été créé avec succès à l'emplacement : $filepath";
}

function creation_page_user_normal($id_user, $nom, $email, $password, $date_de_naissance, $type_user) {
    if ($type_user === 'un_employe') {
        $content = "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>Page Employé</title>
            <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css\">
            <script src=\"https://cdn.tailwindcss.com\"></script>
            <style>
                nav {
                    background-color: rgb(103, 171, 121);
                }
            </style>
        </head>
        <body>
            <nav class=\"navbar navbar-expand-lg bg-body-tertiary p-6\">
                <div class=\"container-fluid\">
                    <span>Bienvenue, $nom (Employé)</span>
                </div>
            </nav>
        </body>
        </html>";
        save_to_file("page_employe_$id_user.php", $content);
    } else {
        echo "Type d'utilisateur non valide pour cette page.";
    }
}

function creation_page_chef_projet($id_user, $nom, $email, $password, $date_de_naissance, $type_user) {
    if ($type_user === 'chef_de_projet') {
        $content = "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>Chef de Projet - Gestion des Projets</title>
            <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
            <script src=\"https://cdn.tailwindcss.com\"></script>
            <style>
                nav, button {
                    background-color: rgb(103, 171, 121);
                }
            </style>
        </head>
        <body class=\"bg-gray-100\">
            <nav class=\"navbar navbar-expand-lg navbar-light text-white py-3\">
                <div class=\"container-fluid\">
                    <a class=\"navbar-brand text-white\" href=\"#\">Chef de Projet</a>
                    <button class=\"btn btn-light\" onclick=\"toggleProjectForm()\">Ajouter un Projet</button>
                </div>
            </nav>
            <script>
                function toggleProjectForm() {
                    const form = document.getElementById('projectForm');
                    form.classList.toggle('d-none');
                }
            </script>
        </body>
        </html>";
        save_to_file("page_chef_projet_$id_user.php", $content);
    } else {
        echo "Type d'utilisateur non valide pour cette page.";
    }
}


?>