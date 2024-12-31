<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body >
    <div  class="jumbotron bg-green-300 "></div>
   <form action="" class="w-1/3 justify-self-center shadow-lg space-y-4 p-10 gap-4 rounded-xl">
   <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">nom_prenom</label>
  <input type="name" class="form-control" id="exampleFormControlInput1" placeholder="votre_nom">
</div>
   <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
</div>
<div class="col g-3 align-items-center">
  <div class="col-auto">
    <label for="inputPassword6" class="col-form-label">Password</label>
  </div>
  <div class="col-auto">
    <input type="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
  </div>
  <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      Must be 8-20 characters long.
    </span>
  </div>
</div>
<select class="form-select" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <option value="1">chef_de_projet</option>
  <option value="2"> membre d’équipe</option>
</select>
<div>
    <button type="submit" class="btn btn-primary bg-green-300">creation_de_compte</button>
</div>
   </form>

</body>
</html>