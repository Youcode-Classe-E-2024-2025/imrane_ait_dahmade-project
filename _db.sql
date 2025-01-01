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

