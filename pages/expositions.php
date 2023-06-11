<?php
// Importer le fichier de configuration
require_once '../utils/config.php';

// Récupérer les expositions
$stmt = $pdo->query("SELECT * FROM expositions");
$expositions = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- pages/expositions.php -->

<?php include '../components/navbar.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Expositions - 24Inchs</title>
    <meta name="description" content="Site de Maxim Armrengol Casino">
</head>

<body>
    <h2>Expositions</h2>

    <?php foreach ($expositions as $exposition) { ?>
        <h3><?php echo $exposition['expositions_nom']; ?></h3>
        <p>Lieu: <?php echo $exposition['expositions_lieu']; ?></p>
        <p>Date: <?php echo $exposition['expositions_date']; ?></p>

        <!-- Récupérer les photos associées à l'exposition -->
        <?php
        $stmt = $pdo->prepare("SELECT * FROM gallerie WHERE id_photo IN (SELECT id_photo FROM expositions WHERE id_expositions = ?)");
        $stmt->execute([$exposition['id_expositions']]);
        $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="gallery">
            <?php foreach ($photos as $photo) { ?>
                <div class="photo">
                    <img src="<?php echo $photo['photo_url']; ?>" alt="<?php echo $photo['photo_nom']; ?>">
                    <h4><?php echo $photo['photo_nom']; ?></h4>
                    <p><?php echo $photo['photo_description']; ?></p>
                    <p>Date: <?php echo $photo['photo_date']; ?></p>
                </div>
            <?php } ?>
        </div>

    <?php } ?>
    <?php include '../components/footer.php'; ?>
</body>

</html>
