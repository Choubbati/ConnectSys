<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil - Gestion des Contacts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include_once 'include/nav.php'; ?>

<div class="container mt-5">

    <div class="alert alert-success">
         Bienvenue 
        <strong><?= htmlspecialchars($_SESSION["user"]["username"]) ?></strong>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
             Informations du profil
        </div>

        <div class="card-body">
            <p>
                <strong>Nom d'utilisateur :</strong>
                <?= htmlspecialchars($_SESSION["user"]["username"]) ?>
            </p>

            <p>
                <strong>Date d'inscription :</strong>
                <?= htmlspecialchars($_SESSION["user"]["date_creation"]) ?>
            </p>

            <p>
                <strong>Heure de connexion :</strong>
                <?= $_SESSION["login_time"] ?? "Non disponible" ?>
            </p>

            <p>
                <strong>Date de connexion :</strong>
                <?= $_SESSION["login_date"] ?? "Non disponible" ?>
            </p>

            <div class="mt-4 d-flex gap-2">
                <a href="contacts.php" class="btn btn-primary">
                     Gérer mes contacts
                </a>

                <a href="auth/logout.php" class="btn btn-danger">
                     Déconnexion
                </a>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
