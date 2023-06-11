<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier une photo</title>
</head>
<body>
    <h1>Modifier une photo</h1>
    
    <?php
    // Importer le fichier de configuration
    require_once '../utils/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Valider les données du formulaire
        $id_photo = $_POST['id_photo'];
        $photo_nom = htmlspecialchars($_POST['photo_nom']);
        $photo_description = htmlspecialchars($_POST['photo_description']);
        $photo_date = $_POST['photo_date'];
        $photo_url = $_POST['photo_url'];
    
        // Effectuer la requête de mise à jour en utilisant une requête préparée pour éviter les injections SQL
        $stmt = $pdo->prepare("UPDATE gallerie SET photo_nom=?, photo_description=?, photo_date=?, photo_url=? WHERE id_photo=?");
        $stmt->execute([$photo_nom, $photo_description, $photo_date, $photo_url, $id_photo]);
    
        // Afficher un message de succès
        echo "La photo a été mise à jour avec succès !";
    }
    ?>

    <form method="POST" action="photo_update.php">
        <label for="id_photo">ID de la photo :</label>
        <input type="number" name="id_photo" id="id_photo" required>
        
        <label for="photo_nom">Nom de la photo :</label>
        <input type="text" name="photo_nom" id="photo_nom" required>
        
        <label for="photo_description">Description :</label>
        <input type="text" name="photo_description" id="photo_description" required>
        
        <label for="photo_date">Date :</label>
        <input type="date" name="photo_date" id="photo_date" required>
        
        <input type="submit" value="Modifier">
    </form>

    <style>
    h1{
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

</body>
</html>
