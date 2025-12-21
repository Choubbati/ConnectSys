<?php 
include '../database/connextion.php';
session_start();
if(isset($_SESSION['user'])){
    header('Location: ../profil.php');
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Créer un compte</title>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card p-4 shadow" style="width: 350px;">

        <h3 class="text-center mb-3">Se Connecter</h3>


        <form method="POST" action="../auth/authotification.php">
            <div class="mb-3">
                <label class="form-label">Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button type="submit" name="submit" value="login" class="btn btn-success  w-100">
                Se Connecter
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="../auth/register.php">S'inscrire</a>
        </div>

    </div>
</div>

</body>
</html>
