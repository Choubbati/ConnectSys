<?php
session_start();
require '../database/connextion.php';

$user_id = $_SESSION['user']['id'];

if (isset($_POST['add'])) {
    $sql = $pdo->prepare(
        "INSERT INTO contacts (user_id, name, phone, email, address)
         VALUES (?, ?, ?, ?, ?)"
    );
    $sql->execute([
        $user_id,
        $_POST['name'],
        $_POST['phone'],
        $_POST['email'],
        $_POST['address']
    ]);

    $_SESSION['message'] = "<div class='alert alert-success'>Contact ajouté</div>";
    header("Location: ../contacts.php");
    exit;
}

if (isset($_POST['update'])) {
    $sql = $pdo->prepare(
        "UPDATE contacts
         SET name=?, phone=?, email=?, address=?
         WHERE id=? AND user_id=?"
    );
    $sql->execute([
        $_POST['name'],
        $_POST['phone'],
        $_POST['email'],
        $_POST['address'],
        $_POST['id'],
        $user_id
    ]);

    $_SESSION['message'] = "<div class='alert alert-success'>Contact modifié</div>";
    header("Location: ../contacts.php");
    exit;
}

if (isset($_GET['delete'])) {
    $sql = $pdo->prepare("DELETE FROM contacts WHERE id=? AND user_id=?");
    $sql->execute([$_GET['delete'], $user_id]);

    $_SESSION['message'] = "<div class='alert alert-danger'>Contact supprimé</div>";
    header("Location: ../contacts.php");
    exit;
}
