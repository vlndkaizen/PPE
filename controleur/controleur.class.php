    <?php
    require_once("modele/modele.class.php");

    class Controleur {
        private $unModele;

        public function __construct() {
            $this->unModele = new Modele();
        }

        /* --- CONNEXION --- */
        public function verifConnexion($email, $mdp) {
            return $this->unModele->verifConnexion(trim($email), $mdp);
        }

        public function verifConnexionCandidat($email, $mdp) {
            return $this->unModele->verifConnexionCandidat(trim($email), $mdp);
        }

        // AJOUT: Connexion moniteur
        public function verifConnexionMoniteur($email, $mdp) {
            return $this->unModele->verifConnexionMoniteur(trim($email), $mdp);
        }

        /* --- PLANNING --- */
        public function selectCours_byCandidat($idcandidat) {
            return $this->unModele->selectCours_byCandidat($idcandidat);
        }

        // AJOUT: Planning moniteur
        public function selectCours_byMoniteur($idmoniteur) {
            return $this->unModele->selectCours_byMoniteur($idmoniteur);
        }

        // AJOUT: Compter cours restants
        public function countCoursRestants($idcandidat) {
            return $this->unModele->countCoursRestants($idcandidat);
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
        public function changerMotDePassePremierConnexion($idcandidat, $nouveau_mdp) {
        $this->unModele->changerMotDePassePremierConnexion($idcandidat, $nouveau_mdp);
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

        /* --- COURS --- */
        public function insert_cours($tab) {
            $this->unModele->insert_cours($tab);
        }

        public function selectAll_cours() {
            return $this->unModele->selectAll_cours();
        }

        // AJOUT: Gestion CRUD cours
        public function selectWhere_cours($idcours) {
            return $this->unModele->selectWhere_cours($idcours);
        }

        public function update_cours($tab) {
            $this->unModele->update_cours($tab);
        }

        public function delete_cours($idcours) {
            $this->unModele->delete_cours($idcours);
        }
    }
    ?>