<?php
session_start();
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

$message = '';
$leCandidat = $leMoniteur = $leVehicule = $leCours = null;
$lescandidats = $lesmoniteurs = $lesvehicules = $lescours = array();

// === CONNEXION (ADMIN / CANDIDAT / MONITEUR) ===
if (isset($_POST['Connexion'])) {
    // Vérifier admin
    $user = $unControleur->verifConnexion($_POST['email'], $_POST['mdp']);
    if ($user) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['role'] = 'admin';
        header("Location: index.php?page=5");
        exit();
    }
    
    // Vérifier candidat
    $candidat = $unControleur->verifConnexionCandidat($_POST['email'], $_POST['mdp']);
    if ($candidat) {
        $_SESSION['email'] = $candidat['email'];
        $_SESSION['nom'] = $candidat['nom'];
        $_SESSION['prenom'] = $candidat['prenom'];
        $_SESSION['idcandidat'] = $candidat['idcandidat'];
        $_SESSION['role'] = 'candidat';
        header("Location: index.php?page=50");
        exit();
    }
    
    // AJOUT: Vérifier moniteur
    $moniteur = $unControleur->verifConnexionMoniteur($_POST['email'], $_POST['mdp']);
    if ($moniteur) {
        $_SESSION['email'] = $moniteur['email'];
        $_SESSION['nom'] = $moniteur['nom'];
        $_SESSION['prenom'] = $moniteur['prenom'];
        $_SESSION['idmoniteur'] = $moniteur['idmoniteur'];
        $_SESSION['role'] = 'moniteur';
        header("Location: index.php?page=60");
        exit();
    }
    
    $message = '<div class="alert alert-error">Identifiants incorrects</div>';
}

// === INSCRIPTION ===
if (isset($_POST['Sinscrire'])) {
    $unControleur->insert_candidat($_POST);
    $message = '<div class="alert alert-success">Inscription réussie ! Nous vous contacterons sous 24h.</div>';
}

// === GESTION ADMIN ===
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    // Candidats
    if (isset($_POST['valider'])) { 
        $unControleur->insert_candidat($_POST);
        header("Location: index.php?page=5");
        exit();
    }
    if (isset($_POST['Modifier'])) { 
        $unControleur->update_candidat($_POST);
        header("Location: index.php?page=5");
        exit();
    }
    if (isset($_GET['action']) && $_GET['action'] == 'sup' && isset($_GET['idcandidat'])) {
        $unControleur->delete_candidat($_GET['idcandidat']);
        header("Location: index.php?page=5");
        exit();
    }

    // Moniteurs
    if (isset($_POST['valider_moniteur'])) {
        $unControleur->insert_moniteur($_POST);
        header("Location: index.php?page=6");
        exit();
    }
    if (isset($_POST['ModifierMoniteur'])) {
        $unControleur->update_moniteur($_POST);
        header("Location: index.php?page=6");
        exit();
    }
    if (isset($_GET['action']) && $_GET['action'] == 'supMoniteur' && isset($_GET['idmoniteur'])) {
        $unControleur->delete_moniteur($_GET['idmoniteur']);
        header("Location: index.php?page=6");
        exit();
    }

    // Véhicules
    if (isset($_POST['valider_vehicule'])) {
        $unControleur->insert_vehicule($_POST);
        header("Location: index.php?page=7");
        exit();
    }
    if (isset($_POST['ModifierVehicule'])) {
        $unControleur->update_vehicule($_POST);
        header("Location: index.php?page=7");
        exit();
    }
    if (isset($_GET['action']) && $_GET['action'] == 'supVehicule' && isset($_GET['idvehicule'])) {
        $unControleur->delete_vehicule($_GET['idvehicule']);
        header("Location: index.php?page=7");
        exit();
    }

    // AJOUT: Cours
    if (isset($_POST['planifier'])) {
        $unControleur->insert_cours($_POST);
        header("Location: index.php?page=8");
        exit();
    }
    if (isset($_POST['ModifierCours'])) {
        $unControleur->update_cours($_POST);
        header("Location: index.php?page=8");
        exit();
    }
    if (isset($_GET['action']) && $_GET['action'] == 'supCours' && isset($_GET['idcours'])) {
        $unControleur->delete_cours($_GET['idcours']);
        header("Location: index.php?page=8");
        exit();
    }
}

// === DÉCONNEXION ===
if (isset($_GET['page']) && $_GET['page'] == 9) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Castellane Auto</title>
    <link rel="stylesheet" href="design/style.css">
</head>
<body>

<?php include("vue/entete.php"); ?>

<main>
    <?php if($message) echo $message; ?>
    
    <?php
    $page = $_GET['page'] ?? 1;

    switch ($page) {
        case 1: include("vue/public/accueil.php"); break;
        case 2: include("vue/public/tarifs.php"); break;
        case 3: 
            $lesvehicules = $unControleur->selectAll_vehicules();
            $lesvehicules = array_filter($lesvehicules, function($v) {
                return $v['etat'] == 'Disponible';
            });
            include("vue/public/flotte.php");
            break;
        case 4: include("vue/public/test_code.php"); break;
        case 10: include("vue/public/vue_inscription.php"); break;
        case 20: include("vue/public/permis_b.php"); break;
        case 21: include("vue/public/permis_aac.php"); break;
        case 22: include("vue/public/permis_moto.php"); break;
        case 99: include("vue/vue_connexion.php"); break;

        // PAGES CANDIDAT
        case 50: // Planning candidat
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'candidat') {
                $lescours = $unControleur->selectCours_byCandidat($_SESSION['idcandidat']);
                $nbRestants = $unControleur->countCoursRestants($_SESSION['idcandidat']);
                include("vue/admin/vue_planning_candidat.php");
            } else {
                header("Location: index.php?page=99");
                exit();
            }
            break;

        // AJOUT: PAGES MONITEUR
        case 60: // Planning moniteur
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'moniteur') {
                $lescours = $unControleur->selectCours_byMoniteur($_SESSION['idmoniteur']);
                include("vue/admin/vue_planning_moniteur.php");
            } else {
                header("Location: index.php?page=99");
                exit();
            }
            break;

        // PAGES ADMIN
        case 5: // Candidats
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                    $leCandidat = $unControleur->selectWhere_candidat($_GET['idcandidat']);
                }
                include("vue/admin/vue_insert_candidat.php");
                $lescandidats = $unControleur->selectAll_candidats();
                include("vue/admin/vue_select_candidat.php");
            } else {
                header("Location: index.php?page=99");
                exit();
            }
            break;

        case 6: // Moniteurs
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                if (isset($_GET['action']) && $_GET['action'] == 'editMoniteur') {
                    $leMoniteur = $unControleur->selectWhere_moniteur($_GET['idmoniteur']);
                }
                include("vue/admin/vue_insert_moniteur.php");
                $lesmoniteurs = $unControleur->selectAll_moniteurs();
                include("vue/admin/vue_select_moniteur.php");
            } else {
                header("Location: index.php?page=99");
                exit();
            }
            break;

        case 7: // Véhicules
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                if (isset($_GET['action']) && $_GET['action'] == 'editVehicule') {
                    $leVehicule = $unControleur->selectWhere_vehicule($_GET['idvehicule']);
                }
                include("vue/admin/vue_insert_vehicule.php");
                $lesvehicules = $unControleur->selectAll_vehicules();
                include("vue/admin/vue_select_vehicule.php");
            } else {
                header("Location: index.php?page=99");
                exit();
            }
            break;

        case 8: // AJOUT: Planning/Cours admin (CRUD complet)
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                if (isset($_GET['action']) && $_GET['action'] == 'editCours') {
                    $leCours = $unControleur->selectWhere_cours($_GET['idcours']);
                }
                $lescandidats = $unControleur->selectAll_candidats();
                $lesmoniteurs = $unControleur->selectAll_moniteurs();
                $lesvehicules = $unControleur->selectAll_vehicules();
                include("vue/admin/vue_insert_cours.php");
                $lescours = $unControleur->selectAll_cours();
                include("vue/admin/vue_select_cours.php");
            } else {
                header("Location: index.php?page=99");
                exit();
            }
            break;

        default: include("vue/public/accueil.php"); break;
    }
    ?>
</main>

</body>
</html>