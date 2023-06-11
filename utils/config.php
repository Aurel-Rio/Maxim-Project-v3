<?php
// Configuration de la base de données
$dbHost = 'localhost';
$dbName = 'maximarmengolcasino';
$dbUser = 'root';
$dbPassword = '';

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
    // Configurer PDO pour afficher les erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher l'erreur
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}
?>
