<?php
class Modele {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=auto_ecole;charset=utf8mb4", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur connexion : " . $e->getMessage());
        }
    }

    /* --- CONNEXION --- */

    public function verifConnexion($email, $mdp) {
        $req = "SELECT * FROM utilisateur WHERE email = :email AND role = 'admin'";
        $select = $this->pdo->prepare($req);
        $select->execute(array(":email" => trim($email)));
        $admin = $select->fetch();

        if ($admin) {
            // Check si le mdp est hashé ou en clair (migration)
            if (password_verify(trim($mdp), $admin['mdp'])) {
                return $admin;
            } elseif ($admin['mdp'] === trim($mdp)) {
                // Mdp en clair - migrer vers hash à la volée
                $mdp_hash = password_hash(trim($mdp), PASSWORD_DEFAULT);
                $this->update_mdp_utilisateur($admin['idutilisateur'], $mdp_hash);
                return $admin;
            }
        }
        return false;
    }

    public function verifConnexionCandidat($email, $mdp) {
        $req = "SELECT c.idcandidat, u.idutilisateur, u.nom, u.prenom, u.email, u.mdp, u.premier_connexion,
                        c.date_prevue_code, c.date_prevue_permis, c.est_etudiant, c.nom_ecole
                FROM utilisateur u
                INNER JOIN candidats c ON c.idutilisateur = u.idutilisateur
                WHERE u.email = :email AND u.role = 'candidat'";
        $select = $this->pdo->prepare($req);
        $select->execute([":email" => trim($email)]);
        $candidat = $select->fetch();

        if ($candidat && password_verify(trim($mdp), $candidat['mdp'])) {
            return $candidat;
        }
        return false;
    }

    public function verifConnexionMoniteur($email, $mdp) {
        $req = "SELECT m.idmoniteur, u.idutilisateur, u.nom, u.prenom, u.email, u.mdp,
                        m.experience, m.type_permis
                FROM utilisateur u
                INNER JOIN moniteur m ON m.idutilisateur = u.idutilisateur
                WHERE u.email = :email AND u.role = 'moniteur'";
        $select = $this->pdo->prepare($req);
        $select->execute(array(":email" => trim($email)));
        $moniteur = $select->fetch();

        if ($moniteur && password_verify(trim($mdp), $moniteur['mdp'])) {
            return $moniteur;
        }
        return false;
    }

    private function update_mdp_utilisateur($idutilisateur, $mdp_hash) {
        $req = "UPDATE utilisateur SET mdp = :mdp WHERE idutilisateur = :idutilisateur";
        $update = $this->pdo->prepare($req);
        $update->execute([":mdp" => $mdp_hash, ":idutilisateur" => $idutilisateur]);
    }

    /* --- PLANNING --- */
    public function selectCours_byCandidat($idcandidat) {
        $req = "SELECT c.*,
                   CONCAT(mu.nom, ' ', mu.prenom) as nom_moniteur,
                   CONCAT(v.marque, ' ', v.modele) as modele_vehicule,
                   v.immatriculation
            FROM cours c
            INNER JOIN moniteur m ON c.idmoniteur = m.idmoniteur
            INNER JOIN utilisateur mu ON m.idutilisateur = mu.idutilisateur
            INNER JOIN vehicule v ON c.idvehicule = v.idvehicule
            WHERE c.idcandidat = :idcandidat
            ORDER BY c.date_cours ASC, c.heure_debut ASC";
        $select = $this->pdo->prepare($req);
        $select->execute(array(":idcandidat" => $idcandidat));
        return $select->fetchAll();
    }

    public function selectCours_byMoniteur($idmoniteur) {
        $req = "SELECT c.*,
                   CONCAT(cu.nom, ' ', cu.prenom) as nom_candidat,
                   cu.tel as tel_candidat,
                   CONCAT(v.marque, ' ', v.modele) as modele_vehicule,
                   v.immatriculation
            FROM cours c
            INNER JOIN candidats cand ON c.idcandidat = cand.idcandidat
            INNER JOIN utilisateur cu ON cand.idutilisateur = cu.idutilisateur
            INNER JOIN vehicule v ON c.idvehicule = v.idvehicule
            WHERE c.idmoniteur = :idmoniteur
            ORDER BY c.date_cours ASC, c.heure_debut ASC";
        $select = $this->pdo->prepare($req);
        $select->execute(array(":idmoniteur" => $idmoniteur));
        return $select->fetchAll();
    }

    public function countCoursRestants($idcandidat) {
        $req = "SELECT COUNT(*) as nb FROM cours WHERE idcandidat = :idcandidat AND statut = 'À venir'";
        $select = $this->pdo->prepare($req);
        $select->execute(array(":idcandidat" => $idcandidat));
        $result = $select->fetch();
        return $result['nb'];
    }

    /* --- CANDIDATS --- */
    public function insert_candidat($tab) {
        // Transaction: INSERT utilisateur PUIS candidats
        try {
            $this->pdo->beginTransaction();

            // 1. INSERT dans utilisateur
            $req_user = "INSERT INTO utilisateur
                         (nom, prenom, email, mdp, tel, adresse, role, premier_connexion)
                         VALUES
                         (:nom, :prenom, :email, :mdp, :tel, :adresse, 'candidat', :premier_connexion)";
            $insert_user = $this->pdo->prepare($req_user);

            $mdp_hash = password_hash(trim($tab['mdp']), PASSWORD_DEFAULT);
            $insert_user->execute([
                ":nom" => trim($tab['nom']),
                ":prenom" => trim($tab['prenom']),
                ":email" => trim($tab['email']),
                ":tel" => isset($tab['tel']) ? trim($tab['tel']) : null,
                ":adresse" => isset($tab['adresse']) ? trim($tab['adresse']) : null,
                ":mdp" => $mdp_hash,
                ":premier_connexion" => $tab['premier_connexion'] ?? 1
            ]);

            $idutilisateur = $this->pdo->lastInsertId();

            // 2. INSERT dans candidats
            $req_cand = "INSERT INTO candidats
                         (idutilisateur, est_etudiant, nom_ecole, date_prevue_code, date_prevue_permis)
                         VALUES
                         (:idutilisateur, :est_etudiant, :nom_ecole, NULL, NULL)";
            $insert_cand = $this->pdo->prepare($req_cand);
            $insert_cand->execute([
                ":idutilisateur" => $idutilisateur,
                ":est_etudiant" => $tab['est_etudiant'] ?? 0,
                ":nom_ecole" => isset($tab['nom_ecole']) ? trim($tab['nom_ecole']) : null
            ]);

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function selectAll_candidats() {
        $req = "SELECT c.idcandidat, u.idutilisateur, u.nom, u.prenom, u.email, u.tel, u.adresse,
                        c.est_etudiant, c.nom_ecole, c.date_prevue_code, c.date_prevue_permis
                FROM candidats c
                INNER JOIN utilisateur u ON c.idutilisateur = u.idutilisateur
                ORDER BY u.nom ASC";
        $select = $this->pdo->prepare($req);
        $select->execute();
        return $select->fetchAll();
    }

    public function delete_candidat($idcandidat) {
        $req_find = "SELECT idutilisateur FROM candidats WHERE idcandidat = :idcandidat";
        $find = $this->pdo->prepare($req_find);
        $find->execute(array(":idcandidat" => $idcandidat));
        $result = $find->fetch();

        if ($result) {
            // Supprimer l'utilisateur parent → la FK CASCADE supprime automatiquement le candidat
            $req = "DELETE FROM utilisateur WHERE idutilisateur = :idutilisateur";
            $delete = $this->pdo->prepare($req);
            $delete->execute(array(":idutilisateur" => $result['idutilisateur']));
        }
    }

    public function selectWhere_candidat($idcandidat) {
        $req = "SELECT c.idcandidat, u.idutilisateur, u.nom, u.prenom, u.email, u.tel, u.adresse,
                        c.est_etudiant, c.nom_ecole, c.date_prevue_code, c.date_prevue_permis
                FROM candidats c
                INNER JOIN utilisateur u ON c.idutilisateur = u.idutilisateur
                WHERE c.idcandidat = :idcandidat";
        $select = $this->pdo->prepare($req);
        $select->execute(array(":idcandidat" => $idcandidat));
        return $select->fetch();
    }

    public function update_candidat($tab) {
        try {
            $this->pdo->beginTransaction();

            // Trouver idutilisateur
            $req_find = "SELECT idutilisateur FROM candidats WHERE idcandidat = :idcandidat";
            $find = $this->pdo->prepare($req_find);
            $find->execute(array(":idcandidat" => $tab['idcandidat']));
            $cand = $find->fetch();
            $idutilisateur = $cand['idutilisateur'];

            // UPDATE utilisateur
            if (!empty($tab['mdp'])) {
                $mdp_hash = password_hash(trim($tab['mdp']), PASSWORD_DEFAULT);
                $req_user = "UPDATE utilisateur SET nom=:nom, prenom=:prenom, email=:email, mdp=:mdp, tel=:tel, adresse=:adresse WHERE idutilisateur=:idutilisateur";
                $update_user = $this->pdo->prepare($req_user);
                $update_user->execute(array(
                    ":nom" => trim($tab['nom']),
                    ":prenom" => trim($tab['prenom']),
                    ":email" => trim($tab['email']),
                    ":mdp" => $mdp_hash,
                    ":tel" => isset($tab['tel']) ? trim($tab['tel']) : null,
                    ":adresse" => isset($tab['adresse']) ? trim($tab['adresse']) : null,
                    ":idutilisateur" => $idutilisateur
                ));
            } else {
                $req_user = "UPDATE utilisateur SET nom=:nom, prenom=:prenom, email=:email, tel=:tel, adresse=:adresse WHERE idutilisateur=:idutilisateur";
                $update_user = $this->pdo->prepare($req_user);
                $update_user->execute(array(
                    ":nom" => trim($tab['nom']),
                    ":prenom" => trim($tab['prenom']),
                    ":email" => trim($tab['email']),
                    ":tel" => isset($tab['tel']) ? trim($tab['tel']) : null,
                    ":adresse" => isset($tab['adresse']) ? trim($tab['adresse']) : null,
                    ":idutilisateur" => $idutilisateur
                ));
            }

            // UPDATE candidats
            $req_cand = "UPDATE candidats SET est_etudiant=:est_etudiant, nom_ecole=:nom_ecole, date_prevue_code=:date_prevue_code, date_prevue_permis=:date_prevue_permis WHERE idcandidat=:idcandidat";
            $update_cand = $this->pdo->prepare($req_cand);
            $update_cand->execute(array(
                ":est_etudiant" => $tab['est_etudiant'] ?? 0,
                ":nom_ecole" => isset($tab['nom_ecole']) ? trim($tab['nom_ecole']) : null,
                ":date_prevue_code" => isset($tab['date_code']) ? $tab['date_code'] : null,
                ":date_prevue_permis" => isset($tab['date_permis']) ? $tab['date_permis'] : null,
                ":idcandidat" => $tab['idcandidat']
            ));

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function changerMotDePassePremierConnexion($idcandidat, $nouveau_mdp) {
        try {
            $this->pdo->beginTransaction();

            // Trouver idutilisateur
            $req_find = "SELECT idutilisateur FROM candidats WHERE idcandidat = :idcandidat";
            $find = $this->pdo->prepare($req_find);
            $find->execute(array(":idcandidat" => $idcandidat));
            $cand = $find->fetch();

            if ($cand) {
                $mdp_hash = password_hash(trim($nouveau_mdp), PASSWORD_DEFAULT);
                $req = "UPDATE utilisateur SET mdp = :mdp, premier_connexion = 0 WHERE idutilisateur = :idutilisateur";
                $update = $this->pdo->prepare($req);
                $update->execute([
                    ":mdp" => $mdp_hash,
                    ":idutilisateur" => $cand['idutilisateur']
                ]);
            }

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    /* --- MONITEURS --- */
    public function insert_moniteur($tab) {
        try {
            $this->pdo->beginTransaction();

            // 1. INSERT utilisateur
            $req_user = "INSERT INTO utilisateur
                         (nom, prenom, email, mdp, tel, adresse, role, premier_connexion)
                         VALUES
                         (:nom, :prenom, :email, :mdp, :tel, :adresse, 'moniteur', 0)";
            $insert_user = $this->pdo->prepare($req_user);

            $mdp_hash = password_hash(trim($tab['mdp']), PASSWORD_DEFAULT);
            $insert_user->execute(array(
                ":nom" => trim($tab['nom']),
                ":prenom" => trim($tab['prenom']),
                ":email" => trim($tab['email']),
                ":mdp" => $mdp_hash,
                ":tel" => isset($tab['tel']) ? trim($tab['tel']) : null,
                ":adresse" => isset($tab['adresse']) ? trim($tab['adresse']) : null
            ));

            $idutilisateur = $this->pdo->lastInsertId();

            // 2. INSERT moniteur
            $req_mon = "INSERT INTO moniteur (idutilisateur, experience, type_permis)
                        VALUES (:idutilisateur, :experience, :type_permis)";
            $insert_mon = $this->pdo->prepare($req_mon);
            $insert_mon->execute(array(
                ":idutilisateur" => $idutilisateur,
                ":experience" => $tab['experience'] ?? 0,
                ":type_permis" => isset($tab['type_permis']) ? trim($tab['type_permis']) : null
            ));

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function selectAll_moniteurs() {
        $req = "SELECT m.idmoniteur, u.idutilisateur, u.nom, u.prenom, u.email, u.tel, u.adresse,
                        m.experience, m.type_permis
                FROM moniteur m
                INNER JOIN utilisateur u ON m.idutilisateur = u.idutilisateur
                ORDER BY u.nom ASC";
        $select = $this->pdo->prepare($req);
        $select->execute();
        return $select->fetchAll();
    }

    public function delete_moniteur($idmoniteur) {
        $req_find = "SELECT idutilisateur FROM moniteur WHERE idmoniteur = :idmoniteur";
        $find = $this->pdo->prepare($req_find);
        $find->execute(array(":idmoniteur" => $idmoniteur));
        $result = $find->fetch();

        if ($result) {
            // Supprimer l'utilisateur parent → la FK CASCADE supprime automatiquement le moniteur
            $req = "DELETE FROM utilisateur WHERE idutilisateur = :idutilisateur";
            $delete = $this->pdo->prepare($req);
            $delete->execute(array(":idutilisateur" => $result['idutilisateur']));
        }
    }

    public function selectWhere_moniteur($idmoniteur) {
        $req = "SELECT m.idmoniteur, u.idutilisateur, u.nom, u.prenom, u.email, u.tel, u.adresse,
                        m.experience, m.type_permis
                FROM moniteur m
                INNER JOIN utilisateur u ON m.idutilisateur = u.idutilisateur
                WHERE m.idmoniteur = :idmoniteur";
        $select = $this->pdo->prepare($req);
        $select->execute(array(":idmoniteur" => $idmoniteur));
        return $select->fetch();
    }

    public function update_moniteur($tab) {
        try {
            $this->pdo->beginTransaction();

            // Trouver idutilisateur
            $req_find = "SELECT idutilisateur FROM moniteur WHERE idmoniteur = :idmoniteur";
            $find = $this->pdo->prepare($req_find);
            $find->execute(array(":idmoniteur" => $tab['idmoniteur']));
            $mon = $find->fetch();
            $idutilisateur = $mon['idutilisateur'];

            // UPDATE utilisateur
            if (!empty($tab['mdp'])) {
                $mdp_hash = password_hash(trim($tab['mdp']), PASSWORD_DEFAULT);
                $req_user = "UPDATE utilisateur SET nom=:nom, prenom=:prenom, email=:email, mdp=:mdp, tel=:tel, adresse=:adresse WHERE idutilisateur=:idutilisateur";
                $update_user = $this->pdo->prepare($req_user);
                $update_user->execute(array(
                    ":nom" => trim($tab['nom']),
                    ":prenom" => trim($tab['prenom']),
                    ":email" => trim($tab['email']),
                    ":mdp" => $mdp_hash,
                    ":tel" => isset($tab['tel']) ? trim($tab['tel']) : null,
                    ":adresse" => isset($tab['adresse']) ? trim($tab['adresse']) : null,
                    ":idutilisateur" => $idutilisateur
                ));
            } else {
                $req_user = "UPDATE utilisateur SET nom=:nom, prenom=:prenom, email=:email, tel=:tel, adresse=:adresse WHERE idutilisateur=:idutilisateur";
                $update_user = $this->pdo->prepare($req_user);
                $update_user->execute(array(
                    ":nom" => trim($tab['nom']),
                    ":prenom" => trim($tab['prenom']),
                    ":email" => trim($tab['email']),
                    ":tel" => isset($tab['tel']) ? trim($tab['tel']) : null,
                    ":adresse" => isset($tab['adresse']) ? trim($tab['adresse']) : null,
                    ":idutilisateur" => $idutilisateur
                ));
            }

            // UPDATE moniteur
            $req_mon = "UPDATE moniteur SET experience=:experience, type_permis=:type_permis WHERE idmoniteur=:idmoniteur";
            $update_mon = $this->pdo->prepare($req_mon);
            $update_mon->execute(array(
                ":experience" => $tab['experience'] ?? 0,
                ":type_permis" => isset($tab['type_permis']) ? trim($tab['type_permis']) : null,
                ":idmoniteur" => $tab['idmoniteur']
            ));

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    /* --- VEHICULES --- */
    public function insert_vehicule($tab) {
        $req = "INSERT INTO vehicule VALUES (null, :marque, :modele, :immatriculation, :image, :etat)";
        $insert = $this->pdo->prepare($req);
        $insert->execute(array(
            ":marque" => trim($tab['marque']),
            ":modele" => trim($tab['modele']),
            ":immatriculation" => trim($tab['immatriculation']),
            ":image" => $tab['image'] ?? 'default-car.jpg',
            ":etat" => trim($tab['etat'])
        ));
    }

    public function selectAll_vehicules() {
        $req = "SELECT * FROM vehicule ORDER BY marque ASC";
        $select = $this->pdo->prepare($req);
        $select->execute();
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
        $req = "UPDATE vehicule SET marque=:marque, modele=:modele, immatriculation=:immatriculation, image=:image, etat=:etat WHERE idvehicule=:idvehicule";
        $update = $this->pdo->prepare($req);
        $update->execute(array(
            ":marque" => trim($tab['marque']),
            ":modele" => trim($tab['modele']),
            ":immatriculation" => trim($tab['immatriculation']),
            ":image" => $tab['image'] ?? 'default-car.jpg',
            ":etat" => trim($tab['etat']),
            ":idvehicule" => $tab['idvehicule']
        ));
    }

    /* --- COURS --- */
    public function insert_cours($tab) {
        $req = "INSERT INTO cours VALUES (null, :date_cours, :heure_debut, :heure_fin, 'À venir', :idvehicule, :idmoniteur, :idcandidat)";
        $insert = $this->pdo->prepare($req);
        $insert->execute(array(
            ":date_cours" => $tab['date_cours'],
            ":heure_debut" => $tab['heure_debut'],
            ":heure_fin" => $tab['heure_fin'],
            ":idcandidat" => $tab['idcandidat'],
            ":idmoniteur" => $tab['idmoniteur'],
            ":idvehicule" => $tab['idvehicule']
        ));
    }

    public function selectAll_cours() {
        $req = "SELECT c.*,
                   cu.nom as nom_candidat, cu.prenom as prenom_candidat,
                   mu.nom as nom_moniteur, mu.prenom as prenom_moniteur,
                   v.modele as modele_vehicule, v.immatriculation
                FROM cours c
                INNER JOIN candidats cand ON c.idcandidat = cand.idcandidat
                INNER JOIN utilisateur cu ON cand.idutilisateur = cu.idutilisateur
                INNER JOIN moniteur m ON c.idmoniteur = m.idmoniteur
                INNER JOIN utilisateur mu ON m.idutilisateur = mu.idutilisateur
                INNER JOIN vehicule v ON c.idvehicule = v.idvehicule
                ORDER BY c.date_cours DESC, c.heure_debut DESC";
        $select = $this->pdo->prepare($req);
        $select->execute();
        return $select->fetchAll();
    }

    public function selectWhere_cours($idcours) {
        $req = "SELECT * FROM cours WHERE idcours = :idcours";
        $select = $this->pdo->prepare($req);
        $select->execute(array(":idcours" => $idcours));
        return $select->fetch();
    }

    public function update_cours($tab) {
        $req = "UPDATE cours SET date_cours=:date_cours, heure_debut=:heure_debut, heure_fin=:heure_fin, statut=:statut, idcandidat=:idcandidat, idmoniteur=:idmoniteur, idvehicule=:idvehicule WHERE idcours=:idcours";
        $update = $this->pdo->prepare($req);
        $update->execute(array(
            ":date_cours" => $tab['date_cours'],
            ":heure_debut" => $tab['heure_debut'],
            ":heure_fin" => $tab['heure_fin'],
            ":statut" => $tab['statut'],
            ":idcandidat" => $tab['idcandidat'],
            ":idmoniteur" => $tab['idmoniteur'],
            ":idvehicule" => $tab['idvehicule'],
            ":idcours" => $tab['idcours']
        ));
    }

    public function delete_cours($idcours) {
        $req = "DELETE FROM cours WHERE idcours = :idcours";
        $delete = $this->pdo->prepare($req);
        $delete->execute(array(":idcours" => $idcours));
    }
}
?>
