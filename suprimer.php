<?php
session_start();
require_once __DIR__ . '/config/database.php';

if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id =  $_GET['id'];
    $user_id = $_SESSION['user']['id'];

    $sqlState = $pdo->prepare(
        "DELETE FROM contacts WHERE id = ? AND user_id = ? "
        
    );
    $sqlState->execute([$id, $user_id]);
   
}

header("Location: contacts.php");
exit;
