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

-- Véhicules
INSERT INTO vehicule (marque, modele, immatriculation, etat) VALUES 
('Toyota', 'Yaris', 'AA-123-BB', 'Disponible'),
('Peugeot', '208', 'CC-456-DD', 'En réparation'),
('Renault', 'Clio', 'EE-789-FF', 'Disponible');

-- CORRECTIF: Moniteurs avec mots de passe hachés
-- Mot de passe: "123" pour tous (pour les tests)
INSERT INTO moniteur (nom, prenom, email, mdp, tel, experience, type_permis) VALUES
('Dupont', 'Jean', 'dupont@castellane.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0601020304', 10, 'B'),
('Martin', 'Sophie', 'martin@castellane.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0605060708', 5, 'B+A');

-- CORRECTIF: Candidats avec mots de passe hachés  
-- Mot de passe: "123" pour tous (pour les tests)
INSERT INTO candidats (nom, prenom, email, mdp, tel, date_prevue_code) VALUES
('Dieng', 'Mouhammad', 'dieng@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0601020304', '2026-03-15'),
('Leroy', 'Emma', 'emma@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0612345678', '2026-04-01');

-- Cours
INSERT INTO cours (date_cours, heure_debut, heure_fin, statut, idvehicule, idmoniteur, idcandidat) VALUES
('2026-02-10', '09:00:00', '10:00:00', 'Effectué', 1, 1, 1),
('2026-02-25', '14:00:00', '15:00:00', 'À venir', 1, 1, 1),
('2026-02-28', '10:00:00', '11:00:00', 'À venir', 3, 2, 2),
('2026-03-05', '15:00:00', '16:00:00', 'À venir', 1, 1, 1);