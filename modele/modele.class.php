<?php
class Modele {
    private $pdo;

    public function __construct() {
        try {
            // Connexion robuste à la base de données
            $this->pdo = new PDO("mysql:host=localhost;dbname=auto_ecole;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur connexion : " . $e->getMessage());
        }
    }

    /* --- CONNEXION --- */
    public function verifConnexion($email, $mdp) {
        $req = "SELECT * FROM user WHERE email = :email AND mdp = :mdp";
        $select = $this->pdo->prepare($req);
        $select->execute(array(":email" => $email, ":mdp" => $mdp));
        return $select->fetch();
    }

    /* --- GESTION CANDIDATS --- */
    public function insert_candidat($tab) {
        $req = "INSERT INTO candidats VALUES (null, :nom, :prenom, :email, :tel, :adresse, :est_etudiant, :nom_ecole,null,null)";
        $insert = $this->pdo->prepare($req);
        $insert->execute(array(
            ":nom"=>$tab['nom'], ":prenom"=>$tab['prenom'], ":email"=>$tab['email'],
            ":tel"=>$tab['tel'], ":adresse"=>$tab['adresse'], ":est_etudiant"=>$tab['est_etudiant'],
            ":nom_ecole"=>$tab['nom_ecole']
        ));
    }

    public function selectAll_candidats() {
        $req = "SELECT * FROM candidats";
        $select = $this->pdo->prepare($req); $select->execute();
        return $select->fetchAll();
    }

    public function delete_candidat($idcandidat) {
        $req = "DELETE FROM candidats WHERE idcandidat = :idcandidat";
        $delete = $this->pdo->prepare($req);
        $delete->execute(array(":idcandidat" => $idcandidat));
    }

    public function selectWhere_candidat($idcandidat) {
        $req = "SELECT * FROM candidats WHERE idcandidat = :idcandidat";
        $select = $this->pdo->prepare($req);
        $select->execute(array(":idcandidat" => $idcandidat));
        return $select->fetch();
    }

    public function update_candidat($tab) {
        $req = "UPDATE candidats SET nom=:nom, prenom=:prenom, email=:email, tel=:tel, adresse=:adresse, est_etudiant=:est_etudiant, nom_ecole=:nom_ecole, date_prevue_code=:date_prevue_code, date_prevue_permis=:date_prevue_permis WHERE idcandidat=:idcandidat";
        $update = $this->pdo->prepare($req);
        $update->execute(array(
            ":nom"=>$tab['nom'], ":prenom"=>$tab['prenom'], ":email"=>$tab['email'], ":tel"=>$tab['tel'], ":adresse"=>$tab['adresse'], ":est_etudiant"=>$tab['est_etudiant'], ":nom_ecole"=>$tab['nom_ecole'], ":date_prevue_code"=>$tab['date_code'], ":date_prevue_permis"=>$tab['date_permis'], ":idcandidat"=>$tab['idcandidat']
        ));
    }

    /* --- GESTION MONITEURS --- */
    public function insert_moniteur($tab) {
        $req = "INSERT INTO moniteur VALUES (null, :nom, :prenom, :tel, :adresse, :experience, :type_permis)";
        $insert = $this->pdo->prepare($req);
        $insert->execute(array(":nom" => $tab['nom'], ":prenom" => $tab['prenom'], ":tel" => $tab['tel'], ":adresse" => $tab['adresse'], ":experience" => $tab['experience'], ":type_permis" => $tab['type_permis']));
    }

    public function selectAll_moniteurs() {
        $req = "SELECT * FROM moniteur ORDER BY nom ASC";
        $select = $this->pdo->prepare($req); $select->execute();
        return $select->fetchAll();
    }

    public function delete_moniteur($idmoniteur) {
        $req = "DELETE FROM moniteur WHERE idmoniteur = :idmoniteur";
        $delete = $this->pdo->prepare($req);
        $delete->execute(array(":idmoniteur" => $idmoniteur));
    }

    public function selectWhere_moniteur($idmoniteur) {
        $req = "SELECT * FROM moniteur WHERE idmoniteur = :idmoniteur";
        $select = $this->pdo->prepare($req);
        $select->execute(array(":idmoniteur" => $idmoniteur));
        return $select->fetch();
    }

    public function update_moniteur($tab) {
        $req = "UPDATE moniteur SET nom=:nom, prenom=:prenom, tel=:tel, adresse=:adresse, experience=:experience, type_permis=:type_permis WHERE idmoniteur=:idmoniteur";
        $update = $this->pdo->prepare($req);
        $update->execute(array(":nom"=>$tab['nom'], ":prenom"=>$tab['prenom'], ":tel"=>$tab['tel'], ":adresse"=>$tab['adresse'], ":experience"=>$tab['experience'], ":type_permis"=>$tab['type_permis'], ":idmoniteur"=>$tab['idmoniteur']));
    }

    /* --- GESTION VEHICULES --- */
    public function insert_vehicule($tab) {
        $req = "INSERT INTO vehicule VALUES (null, :marque, :modele, :immatriculation, :etat)";
        $insert = $this->pdo->prepare($req);
        $insert->execute(array(":marque" => $tab['marque'], ":modele" => $tab['modele'], ":immatriculation" => $tab['immatriculation'], ":etat" => $tab['etat']));
    }

    public function selectAll_vehicules() {
        $req = "SELECT * FROM vehicule ORDER BY marque ASC";
        $select = $this->pdo->prepare($req); $select->execute();
        return $select->fetchAll();
    }
    
    public function delete_vehicule($idvehicule) {
        $req = "DELETE FROM vehicule WHERE idvehicule = :idvehicule";
        $delete = $this->pdo->prepare($req);
        $delete->execute(array(":idvehicule" => $idvehicule));
    }

    public function selectWhere_vehicule($idvehicule) {
        $req = "SELECT * FROM vehicule WHERE idvehicule = :idvehicule";
        $select = $this->pdo->prepare($req);
        $select->execute(array(":idvehicule" => $idvehicule));
        return $select->fetch();
    }

    public function update_vehicule($tab) {
        $req = "UPDATE vehicule SET marque=:marque, modele=:modele, immatriculation=:immatriculation, etat=:etat WHERE idvehicule=:idvehicule";
        $update = $this->pdo->prepare($req);
        $update->execute(array(":marque"=>$tab['marque'], ":modele"=>$tab['modele'], ":immatriculation"=>$tab['immatriculation'], ":etat"=>$tab['etat'], ":idvehicule"=>$tab['idvehicule']));
    }

    /* --- GESTION COURS --- */
    public function insert_cours($tab) {
        $req = "INSERT INTO cours VALUES (null, :date_cours, :heure_debut, :heure_fin, :idcandidat, :idmoniteur, :idvehicule)";
        $insert = $this->pdo->prepare($req); 
        $insert->execute(array(":date_cours" => $tab['date_cours'], ":heure_debut" => $tab['heure_debut'], ":heure_fin" => $tab['heure_fin'], ":idcandidat" => $tab['idcandidat'], ":idmoniteur" => $tab['idmoniteur'], ":idvehicule" => $tab['idvehicule']));
    }

    public function selectAll_cours() {
        // Jointure pour afficher les NOMS au lieu des IDS dans le tableau final
        $req = "SELECT c.*, cand.nom as nom_candidat, cand.prenom as prenom_candidat, 
                       m.nom as nom_moniteur, v.modele as modele_vehicule 
                FROM cours c 
                INNER JOIN candidats cand ON c.idcandidat = cand.idcandidat 
                INNER JOIN moniteur m ON c.idmoniteur = m.idmoniteur 
                INNER JOIN vehicule v ON c.idvehicule = v.idvehicule
                ORDER BY c.date_cours DESC, c.heure_debut DESC";
        $select = $this->pdo->prepare($req); 
        $select->execute(); 
        return $select->fetchAll();
    }
}
?>