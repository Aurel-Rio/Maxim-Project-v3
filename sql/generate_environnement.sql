-- Création de la base de données
CREATE DATABASE IF NOT EXISTS maximarmengolcasino;

-- Utilisation de la base de données
USE maximarmengolcasino;

-- Création de la table "admin"
CREATE TABLE IF NOT EXISTS admin (
    id INT(11) NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(255) NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

-- Insertion de l'administrateur
INSERT INTO admin (pseudo, mdp) VALUES ('MacSim', '$2y$10$BM8C8VBBn6IOffXkSSptxujmB8VQyODm2dzNvGXoh8yZ0AD46U8G.');

-- Création de la table "gallerie"
CREATE TABLE IF NOT EXISTS gallerie (
    id_photo INT(11) NOT NULL AUTO_INCREMENT,
    photo_nom VARCHAR(255) NOT NULL,
    photo_description VARCHAR(255) NOT NULL,
    photo_date DATE NOT NULL,
    PRIMARY KEY (id_photo)
) ENGINE=InnoDB;

-- Création de la table "expositions"
CREATE TABLE IF NOT EXISTS expositions (
    id_expositions INT(11) NOT NULL AUTO_INCREMENT,
    expositions_nom VARCHAR(255) NOT NULL,
    expositions_lieu VARCHAR(255) NOT NULL,
    expositions_date DATE NOT NULL,
    id_photo INT(11) NOT NULL,
    PRIMARY KEY (id_expositions),
    FOREIGN KEY (id_photo) REFERENCES gallerie(id_photo)
) ENGINE=InnoDB;

/*MaCTarget09*/ /*MacSim*/