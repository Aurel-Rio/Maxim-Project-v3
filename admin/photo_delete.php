<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Supprimer une ou plusieurs photos</title>
</head>

<body>
    <h1>Supprimer une ou plusieurs photos</h1>

    <?php
    // Importer le fichier de configuration
    require_once '../utils/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Vérifier si des photos ont été sélectionnées
        if (!empty($_POST['selected_photos'])) {
            $selectedPhotos = $_POST['selected_photos'];

            // Parcourir les photos sélectionnées et les supprimer
            foreach ($selectedPhotos as $id_photo) {
                // Récupérer le chemin d'accès à la photo avant de la supprimer de la base de données
                $stmt = $pdo->prepare("SELECT photo_url FROM gallerie WHERE id_photo = ?");
                $stmt->execute([$id_photo]);
                $photo = $stmt->fetch();
                $photo_url = $photo['photo_url'];

                // Effectuer la requête de suppression en utilisant une requête préparée pour éviter les injections SQL
                $stmt = $pdo->prepare("DELETE FROM gallerie WHERE id_photo = ?");
                $stmt->execute([$id_photo]);

                // Supprimer le fichier de la photo du dossier de stockage
                if (file_exists($photo_url)) {
                    unlink($photo_url);
                }
            }

            // Afficher un message de succès
            echo "Les photos sélectionnées ont été supprimées avec succès !";
        } else {
            // Afficher un message d'erreur si aucune photo n'a été sélectionnée
            echo "Veuillez sélectionner au moins une photo à supprimer.";
        }
    }

    // Récupérer toutes les photos de la galerie
    $stmt = $pdo->query("SELECT * FROM gallerie");
    $photos = $stmt->fetchAll();
    ?>

    <form method="POST" action="photo_delete.php">
        <div class="gallery">
            <?php foreach ($photos as $photo) { ?>
            <div class="photo">
                <h3><?php echo $photo['photo_nom']; ?></h3>
                <img src="../uploads/<?php echo $photo['photo_url']; ?>" alt="<?php echo $photo['photo_nom']; ?>">
                <p><?php echo $photo['photo_description']; ?></p>
                <p>Date: <?php echo $photo['photo_date']; ?></p>
                <input type="checkbox" name="selected_photos[]" value="<?php echo $photo['id_photo']; ?>">
            </div>
            <?php } ?>
        </div>

        <input type="submit" value="Supprimer les photos sélectionnées">
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
