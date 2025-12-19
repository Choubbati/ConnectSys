<?php
session_start();
include_once '../config/database.php';
if (isset($_SESSION["user"])) {
    header("Location: ../profil.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Inscription</title>
</head>
<body class="bg-light">

<?php include_once '../include/nav.php';?>


<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-4 shadow" style="width: 400px;">
        <h3 class="text-center mb-4">Créer un compte</h3>

<?php
$message = "";

if (isset($_POST['submit'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm  = trim($_POST['confirm']);

    if (!empty($username) && !empty($password) && !empty($confirm)) {

        if ($password !== $confirm) {
            $message = "<div class='alert alert-warning'>Les mots de passe ne correspondent pas.</div>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $date = date("Y-m-d");
            $heure = date("H:i:s");

            try {
                $sql = $pdo->prepare("INSERT INTO users (username, password, date_creation) VALUES (?, ?, ?)");
                $sql->execute([$username, $hashed_password, $date]);
                $message = "<div class='alert alert-success'>Inscription réussie !</div>";
                header('location: login.php');
            } catch (PDOException $e) {
                $message = "<div class='alert alert-danger'>Erreur : " . $e->getMessage() . "</div>";
            }
        }

    } else {
        $message = "<div class='alert alert-warning'>Les champs sont obligatoires.</div>";
    }
}

?>

<?php echo $message; ?> 

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmer le mot de passe</label>
                <input type="password" name="confirm" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-success w-100">S’inscrire</button>
        </form>

        <div class="text-center mt-3">
            <a href="login.php">Déjà un compte ? Se connecter</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>