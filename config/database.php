<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ConnectSys;charset=utf8", "root", "");
} 
catch (PDOException $e) {
    die("Erreur connexion DB : " . $e->getMessage());
}
