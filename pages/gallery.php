<?php
include '../components/navbar.php';
// Importer le fichier de configuration
require_once '../utils/config.php';

// Récupérer les données des photos depuis la base de données
$stmt = $pdo->query("SELECT * FROM gallerie");
$photos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Galerie - 24Inchs</title>
    <meta name="description" content="Site de Maxim Armrengol Casino">
    <link rel="stylesheet" href="../css/gallerie.css">
</head>

<body>
<div class="center_element">
    <section id="gallerie_style"></section>
    <h2>Galerie de photographie</h2>

    <h3>Art digital</h3>
    <div class="gallery">
        <?php foreach ($photos as $photo) {
            if ($photo['photo_categorie'] === 'Art digital') {
        ?>
        <div class="photo">
            <h3><?php echo $photo['photo_nom']; ?></h3>
            <img src="../uploads/<?php echo $photo['photo_url']; ?>" alt="<?php echo $photo['photo_nom']; ?>">
            <p><?php echo $photo['photo_description']; ?></p>
            <p>Date: <?php echo $photo['photo_date']; ?></p>
        </div>
        <?php }
        } ?>
    </div>

    <h3>Noir et Blanc</h3>
    <div class="gallery">
        <?php foreach ($photos as $photo) {
            if ($photo['photo_categorie'] === 'Noir et Blanc') {
        ?>
        <div class="photo">
            <h3><?php echo $photo['photo_nom']; ?></h3>
            <img src="../uploads/<?php echo $photo['photo_url']; ?>" alt="<?php echo $photo['photo_nom']; ?>">
            <p><?php echo $photo['photo_description']; ?></p>
            <p>Date: <?php echo $photo['photo_date']; ?></p>
        </div>
        <?php }
        } ?>
            <?php include '../components/footer.php'; ?>
    </div>
    </div>
</body>

</html>
