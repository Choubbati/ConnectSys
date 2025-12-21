<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow" style="width: 350px;">
        <div class="card-header bg-primary text-white">Créer un compte</div>

        <div class="card-body">
            <form method="POST" action="../auth/authotification.php" onsubmit="return validateForm();">

                <div class="mb-3">
                    <label>Nom d’utilisateur</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                    <small class="text-danger" id="userError"></small>
                </div>

                <div class="mb-3">
                    <label>Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <small class="text-danger" id="passError"></small>
                </div>

                <div class="mb-3">
                    <label>Confirmation mot de passe</label>
                    <input type="password" name="confirm" id="confirm" class="form-control" required>
                    <small class="text-danger" id="confirmError"></small>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    S’inscrire
                </button>
            </form>

        <div class="text-center mt-3">
            <a href="../auth/login.php">Login</a>
        </div>
        </div>
    </div>
</div>
<script src="../js/script.js"></script>
</body>
</html>
