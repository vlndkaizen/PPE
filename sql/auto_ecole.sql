DROP DATABASE IF EXISTS auto_ecole;
CREATE DATABASE auto_ecole;
USE auto_ecole;

CREATE TABLE candidats (
    idcandidat INT(4) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(25),
    prenom VARCHAR(25),
    email VARCHAR(50) UNIQUE,
    mdp VARCHAR(255) NOT NULL,
    tel VARCHAR(25),
    adresse VARCHAR(50),
    est_etudiant BOOLEAN DEFAULT FALSE,
    nom_ecole VARCHAR(50),
    date_prevue_code DATE,
    date_prevue_permis DATE,
    CONSTRAINT pk_c PRIMARY KEY (idcandidat) 
);

CREATE TABLE moniteur (
    idmoniteur INT(4) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(25),
    prenom VARCHAR(25),
    email VARCHAR(50) UNIQUE,
    mdp VARCHAR(255) NOT NULL,
    tel VARCHAR(25),
    adresse VARCHAR(50),
    experience INT(4),
    type_permis VARCHAR(25),
    CONSTRAINT pk_m PRIMARY KEY (idmoniteur)
);

CREATE TABLE vehicule (
    idvehicule INT(4) NOT NULL AUTO_INCREMENT,
    marque VARCHAR(25),
    modele VARCHAR(25),
    immatriculation VARCHAR(20),
    image VARCHAR(255),
    etat VARCHAR(25) DEFAULT 'Disponible',
    CONSTRAINT pk_v PRIMARY KEY (idvehicule)
);

CREATE TABLE cours (
    idcours INT(4) NOT NULL AUTO_INCREMENT,
    date_cours DATE,
    heure_debut TIME,
    heure_fin TIME,
    statut VARCHAR(20) DEFAULT 'À venir',
    idvehicule INT(4) NOT NULL,
    idmoniteur INT(4) NOT NULL,
    idcandidat INT(4) NOT NULL,
    CONSTRAINT pk_co PRIMARY KEY (idcours),
    CONSTRAINT fk_v FOREIGN KEY (idvehicule) REFERENCES vehicule(idvehicule),
    CONSTRAINT fk_m FOREIGN KEY (idmoniteur) REFERENCES moniteur(idmoniteur),
    CONSTRAINT fk_c FOREIGN KEY (idcandidat) REFERENCES candidats(idcandidat)
);

CREATE TABLE user (
    iduser INT(4) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    mdp VARCHAR(255),
    role VARCHAR(20),
    CONSTRAINT pk_u PRIMARY KEY (iduser)
);

-- Admin
INSERT INTO user (nom, prenom, email, mdp, role) VALUES 
('Lejars', 'Murielle', 'admin@castellane.fr', '123', 'admin');

