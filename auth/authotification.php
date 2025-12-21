<?php
session_start();
require '../database/connextion.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Accès interdit");
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$confirm  = $_POST['confirm'] ?? '';

if ($username === '' || $password === '' || $confirm === '') {
    die("Tous les champs sont obligatoires");
}

/* Validation serveur */
if (!preg_match('/^[a-zA-Z0-9]{3,}$/', $username)) {
    die("Nom d'utilisateur invalide");
}

if (strlen($password) < 6) {
    die("Mot de passe trop court");
}

if ($password !== $confirm) {
    die("Les mots de passe ne correspondent pas");
}

/* Vérifier si username existe */
$check = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$check->execute([$username]);

if ($check->fetch()) {
    die("Nom d'utilisateur déjà utilisé");
}

/* Insertion */
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$date = date("Y-m-d H:i:s");

$sql = $pdo->prepare(
    "INSERT INTO users (username, password, created_at)
     VALUES (?, ?, ?)"
);

$sql->execute([$username, $hashedPassword, $date]);

/* Session */
$_SESSION['user'] = [
    'id' => $pdo->lastInsertId(),
    'username' => $username,
    'created_at' => $date
];

/* Redirection */
header("Location: ../profil.php");
exit;
