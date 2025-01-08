CREATE DATABASE PROJET;

USE PROJET;

CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    type_user ENUM(
        'chef_de_projet',
        'un_employe'
    ) DEFAULT 'un_employe'
);

CREATE TABLE projets (
    id_projet INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    date_creation DATE NOT NULL,
    date_deadline DATE NOT NULL,
    id_chef_de_projet INT NOT NULL,
    CONSTRAINT fk_chef_de_projet FOREIGN KEY (id_chef_de_projet) REFERENCES Users (id)
);
-- Création de la table TAGS
CREATE TABLE TAGS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

-- Création de la table categories
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

-- Création de la table taches
CREATE TABLE taches (
    id_tache INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    date_creation DATE NOT NULL,
    date_deadline DATE,
    statut ENUM(
        'en_attente',
        'en_cours',
        'terminee'
    ) DEFAULT 'en_attente',
    id_projet INT NOT NULL,
    id_assigné INT NOT NULL,
    id_tag INT NOT NULL,
    id_categorie INT NOT NULL,
    FOREIGN KEY (id_projet) REFERENCES projets (id_projet),
    FOREIGN KEY (id_assigné) REFERENCES Users (id),
    FOREIGN KEY (id_tag) REFERENCES TAGS (id),
    FOREIGN KEY (id_categorie) REFERENCES categories (id)
);

ALTER TABLE projets ADD COLUMN nomChefProjet varchar(255);

ALTER TABLE projets
ADD CONSTRAINT fk_nomChefProjet FOREIGN KEY (nomChefProjet) REFERENCES users (id);

USE PROJET;

ALTER Table Users ADD UNIQUE (name);

ALTER TABLE projets
ADD CONSTRAINT fk_nomChefProjet FOREIGN KEY (nomChefProjet) REFERENCES users (name);
USE PROJET;
INSERT INTO Projets (nom, description, date_creation, date_deadline, nomChefProjet) VALUES
('Site Web E-commerce', 'Création d\'une plateforme de vente en ligne.', '2025-01-01', '2025-03-01', 'Excepteur in corrupt'),
('Application Mobile', 'Développement d\'une application mobile pour la gestion des tâches.', '2025-01-05', '2025-04-01', 'Excepteur in corrupt'),
('Migration Cloud', 'Migrer les serveurs vers une infrastructure cloud.', '2025-01-10', '2025-02-28', 'Excepteur in corrupt');

ALTER Table  Projets 
ADD COLUMN TypeProjet ENUM('public','prive') DEFAULT 'public';