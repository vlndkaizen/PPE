<?php
require_once("modele/modele.class.php");

class Controleur {
    private $unModele;

    public function __construct() {
        $this->unModele = new Modele();
    }

    /* --- CONNEXION --- */
    public function verifConnexion($email, $mdp) {
        // On peut ajouter ici une petite sécurité supplémentaire (trim)
        return $this->unModele->verifConnexion(trim($email), $mdp);
    }

    
/* === CONNEXION CANDIDAT === */
public function verifConnexionCandidat($email, $mdp) {
    return $this->unModele->verifConnexionCandidat(trim($email), $mdp);
}

/* === PLANNING CANDIDAT === */
public function selectCours_byCandidat($idcandidat) {
    return $this->unModele->selectCours_byCandidat($idcandidat);
}

    /* --- CANDIDATS --- */
    public function insert_candidat($tab) {
        $this->unModele->insert_candidat($tab);
    }

    public function selectAll_candidats() {
        return $this->unModele->selectAll_candidats();
    }

    public function delete_candidat($idcandidat) {
        $this->unModele->delete_candidat($idcandidat);
    }

    public function selectWhere_candidat($idcandidat) {
        return $this->unModele->selectWhere_candidat($idcandidat);
    }

    public function update_candidat($tab) {
        $this->unModele->update_candidat($tab);
    }

    /* --- MONITEURS --- */
public function insert_moniteur($tab){
    return $this->unModele->insert_moniteur($tab);
}

public function update_moniteur($tab){
    return $this->unModele->update_moniteur($tab);
}

public function delete_moniteur($idmoniteur){
    return $this->unModele->delete_moniteur($idmoniteur);
}

public function selectWhere_moniteur($idmoniteur){
    return $this->unModele->selectWhere_moniteur($idmoniteur);
}

public function selectAll_moniteurs(){
    return $this->unModele->selectAll_moniteurs();
}


    /* --- VEHICULES --- */
    public function insert_vehicule($tab) {
        $this->unModele->insert_vehicule($tab);
    }

    public function selectAll_vehicules() {
        return $this->unModele->selectAll_vehicules();
    }

    public function delete_vehicule($idvehicule) {
        $this->unModele->delete_vehicule($idvehicule);
    }

    public function selectWhere_vehicule($idvehicule) {
        return $this->unModele->selectWhere_vehicule($idvehicule);
    }

    public function update_vehicule($tab) {
        $this->unModele->update_vehicule($tab);
    }

    /* --- COURS / PLANNING --- */
    public function insert_cours($tab) {
        $this->unModele->insert_cours($tab);
    }

    public function selectAll_cours() {
        // Cette méthode récupère tous les cours pour ton affichage planning
        return $this->unModele->selectAll_cours();
    }

    // Optionnel : Ajout d'une méthode de recherche si tu veux impressionner le prof
    public function searchCandidats($filtre) {
        return $this->unModele->searchCandidats($filtre);
    }
}
?>