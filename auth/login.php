<?php
session_start();
include_once '../config/database.php';

if (isset($_SESSION["user"])) {
    header("Location: ../profil.php");
    exit;
}
$error = "";

if (isset($_POST["submit"])) {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {

        $sqlState = $pdo->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $sqlState->execute([$username]);
        $user = $sqlState->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            
            $_SESSION["user"] = [
                "id" => $user["id"],
                "username" => $user["username"],
                "date_creation" => $user["date_creation"],
            ];
            $_SESSION["login_time"] = date("H:i:s");
            $_SESSION["login_date"] = date("Y-m-d");

            header("Location: ../profil.php");
            exit;

        } else {
            $error = "Nom d'utilisateur ou mot de passe incorrect";
        }

    } else {
        $error = "Les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Connexion</title>
</head>
<body>

<?php include_once '../include/nav.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card p-4 shadow" style="width: 350px;">
        <h3 class="text-center mb-3">Connexion</h3>

        <?php if (!empty($error)): ?>
            <div class='alert alert-danger'><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary w-100">
                Se connecter
            </button>

            <div class="text-center mt-3">
                <a href="register.php">Créer un compte</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
