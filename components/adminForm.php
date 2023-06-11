<!-- Formulaire de connexion admin -->
  
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire de connexion</title>
</head>
<body>
    <h2>Connexion Administrateur</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="pseudo">Pseudo:</label>
        <input type="text" id="pseudo" name="pseudo" required><br><br>
        
        <label for="mdp">Mot de passe:</label>
        <input type="password" id="mdp" name="mdp" required><br><br>
        
        <input type="submit" value="Se connecter">
    </form>

    <?php
    // Vérifier si le formulaire a été soumis
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Importer le fichier de configuration
    require_once '../utils/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];

        // Valider les données reçues (par exemple, vérifier les longueurs minimales/maximales, les caractères autorisés, etc.)

        // Comparer les identifiants avec ceux de la base de données
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE pseudo = ?");
        $stmt->execute([$pseudo]);
        $admin = $stmt->fetch();

        // Vérifier si l'administrateur existe et que le mot de passe correspond
        if ($admin && password_verify($mdp, $admin['mdp'])) {
            // Authentification réussie, rediriger vers la page de gestion des photos
            header("Location: ../admin/photo_add.php");
            exit();
        } else {
            // Identifiants invalides, afficher un message d'erreur
            echo "Identifiants invalides !";
        }
    }
    ?>
</body>

<style>
    h2{
        margin-top:125px;
        text-align:center;
    }

    form{
        width: min-content;
        display:block;
        margin: auto;
        line-height: 25px;
    }
</style>

</html>