<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ajouter une photo</title>
</head>

<body>
    <h1>Ajouter une photo</h1>

    <?php
    // Importer le fichier de configuration
    require_once '../utils/config.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Valider les données du formulaire
        $photo_nom = htmlspecialchars($_POST['photo_nom']);
        $photo_description = htmlspecialchars($_POST['photo_description']);
        $photo_date = $_POST['photo_date'];
        $photo_categorie = $_POST['photo_categorie'];
        
        // Gérer le téléchargement de la photo
        $photo_url = '';
        if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $photo_tmp_name = $_FILES['photo']['tmp_name'];
            $photo_name = $_FILES['photo']['name'];
            $photo_url = '../uploads/' . $photo_name;
            
            // Déplacer le fichier téléchargé vers le dossier de stockage
            move_uploaded_file($photo_tmp_name, $photo_url);
        } 

        
        // Effectuer la requête d'insertion en utilisant une requête préparée pour éviter les injections SQL
        $stmt = $pdo->prepare("INSERT INTO gallerie (photo_nom, photo_description, photo_date, photo_categorie, photo_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$photo_nom, $photo_description, $photo_date, $photo_categorie, $photo_url]);
        
        // Récupérer l'ID de la photo insérée
        $id_photo = $pdo->lastInsertId();

        // Vérifier si un lieu d'exposition est prévu
        if ($_POST['exposition_lieu'] !== 'n.a') {
            // Valider les coordonnées de l'exposition
            $exposition_nom = $_POST['exposition_nom'];
            $exposition_lieu = $_POST['exposition_lieu'];
            $exposition_date = $_POST['exposition_date'];

            // Insérer les coordonnées de l'exposition dans la table "expositions"
            $stmt = $pdo->prepare("INSERT INTO expositions (expositions_nom, expositions_lieu, expositions_date, id_photo) VALUES (?, ?, ?, ?)");
            $stmt->execute([$exposition_nom, $exposition_lieu, $exposition_date, $id_photo]);
        }
        
        // Afficher un message de succès
        echo "La photo a été ajoutée avec succès !";
    }
    ?>

    <form method="POST" action="photo_add.php" enctype="multipart/form-data">
        <label for="photo_nom">Nom de la photo :</label><br />
        <input type="text" name="photo_nom" id="photo_nom" required><br />

        <label for="photo_description">Description :</label><br />
        <input type="text" name="photo_description" id="photo_description" required><br />

        <label for="photo_date">Date :</label><br />
        <input type="date" name="photo_date" id="photo_date" required><br />

        <label for="photo">Fichier photo :</label><br />
        <input type="file" name="photo" id="photo" required><br />

        <label for="photo_categorie">Catégorie :</label><br />
        <select name="photo_categorie" id="photo_categorie" required><br />
            <option value="Art digital">Art digital</option>
            <option value="Noir et Blanc">Noir et Blanc</option>
        </select><br />

        <label for="exposition_nom">Nom de l'exposition :</label><br />
        <input type="text" name="exposition_nom" id="exposition_nom"><br />

        <label for="exposition_lieu">Lieu de l'exposition :</label><br />
        <input type="text" name="exposition_lieu" id="exposition_lieu"><br />

        <label for="exposition_date">Date de l'exposition :</label><br />
        <input type="date" name="exposition_date" id="exposition_date"><br />
        <input type="submit" value="Ajouter">
    </form>
</body>

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

</html>