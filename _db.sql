 CREATE DATABASE gestionnaire_avance ;
  
  USE  gestionnaire_avance;
  
  CREATE TABLE User (
  id VARCHAR(7) UNIQUE PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  date_naissance DATE DEFAULT '2000-01-01',
  type_user ENUM('chef_de_projet', 'un_employe') DEFAULT 'un_employe'
);

CREATE TABLE projets (
  id_projet TIMESTAMP DEFAULT CURRENT_TIMESTAMP PRIMARY KEY,
  nom_de_projet VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
  date_deadline DATETIME NOT NULL,
  id_chef_de_projet VARCHAR(7) UNIQUE NOT NULL
);



CREATE Table tache (
    id_tache TIMESTAMP DEFAULT CURRENT_TIMESTAMP PRIMARY KEY ,
    nom_de_tache VARCHAR(255) NOT NULL,
    description TEXT not null ,
   type_de_tache ENUM('design', 'script', 'architecture', 'testing') NOT NULL,
    tags ENUM('bug', 'feature', 'basique', 'designing', 'testing'),
    status ENUM('to_do', 'doing', 'done') DEFAULT 'to_do'

)

INSERT INTO User (id, nom, email, password, date_naissance, type_user)
VALUES 
('U00001', 'Alice Dupont', 'alice.dupont@example.com', '$2y$10$e1CwqLhYW1EmnE5k9t5WnO.W.JG3UOoPnq3OiHsEfyRbHn1trGQpa', '1990-03-12', 'chef_de_projet'),
('U00002', 'Bob Martin', 'bob.martin@example.com', '$2y$10$Ln5.OwRMccyE22OtnQVHhe97ZK8wIjoaB/CEgzRnEBCtFNd63CmTm', '1985-07-23', 'un_employe'),
('U00003', 'Charlie Faure', 'charlie.faure@example.com', '$2y$10$DshA7uEtlWpECG4WgM/BCe84Gaf7HOEBlFhxBqq.L37cnBBK2LgBe', '1992-11-15', 'un_employe');

INSERT INTO projets (nom_de_projet, description, date_deadline, id_chef_de_projet)
VALUES
('Gestion des Stocks', 'Développement d\'une application pour gérer les stocks.', '2025-06-01 23:59:59', 'U00001');
 
INSERT INTO projets (nom_de_projet, description, date_deadline, id_chef_de_projet)
VALUES('Site E-commerce', 'Création d\'un site de vente en ligne.', '2025-08-15 23:59:59', 'U00001');

INSERT INTO projets (nom_de_projet, description, date_deadline, id_chef_de_projet)
VALUES
('Application Mobile', 'Développement d\'une application mobile pour une entreprise.', '2025-12-30 23:59:59', 'U00001');

ALTER Table projets
DROP  CONSTRAINT  id_chef_de_projet ;
ALTER TABLE projets
ADD CONSTRAINT fk_id_chef_de_projet
FOREIGN KEY (id_chef_de_projet) REFERENCES User(id);

ALTER Table tache 
ADD COLUMN id_projet TIMESTAMP DEFAULT CURRENT_TIMESTAMP ;
ALTER TABLE tache
Foreign Key (id_projet) REFERENCES projets(id_projet);

ALTER Table tache 
drop COLUMN id_projet ;
-- Ajouter la colonne id_projet
ALTER TABLE tache 
ADD COLUMN id_projet TIMESTAMP ;

-- Ajouter la contrainte de clé étrangère
ALTER TABLE tache 
ADD CONSTRAINT fk_id_projet  FOREIGN KEY (id_projet) REFERENCES projets(id_projet);

 USE  gestionnaire_avance;
ALTER TABLE projets 
ADD COLUMN type ENUM('public','prive') DEFAULT 'public';
