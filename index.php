<?php
    session_start();
    require_once("controleur/controleur.class.php");
    $unControleur = new Controleur(); 

    // --- LOGIQUE DE CONNEXION ---
    if (isset($_POST['Connexion'])) {
        $user = $unControleur->verifConnexion($_POST['email'], $_POST['mdp']);
        if ($user) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php?page=1"); exit();
        } else { $erreur = "Identifiants incorrects."; }
    }

    // --- ACTIONS ADMIN ---
    if (isset($_SESSION['email'])) {
        // Candidats
        if (isset($_POST['valider'])) $unControleur->insertCandidat($_POST);
        if (isset($_POST['Modifier'])) { $unControleur->updateCandidat($_POST); header("Location: index.php?page=5"); }
        if (isset($_GET['action']) && $_GET['action'] == 'sup' && isset($_GET['idcandidat'])) $unControleur->deleteCandidat($_GET['idcandidat']);
        
        // Moniteurs
        if (isset($_POST['valider_moniteur'])) $unControleur->insertMoniteur($_POST);
        if (isset($_POST['ModifierMoniteur'])) { $unControleur->updateMoniteur($_POST); header("Location: index.php?page=6"); }
        if (isset($_GET['action']) && $_GET['action'] == 'sup' && isset($_GET['idmoniteur'])) $unControleur->deleteMoniteur($_GET['idmoniteur']);

        // Véhicules
        if (isset($_POST['valider_vehicule'])) $unControleur->insertVehicule($_POST);
        if (isset($_POST['ModifierVehicule'])) { $unControleur->updateVehicule($_POST); header("Location: index.php?page=7"); }

        // Planning
        if (isset($_POST['planifier'])) $unControleur->insertCours($_POST);
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Castellane Auto | Elite</title>
    <link rel="stylesheet" href="design/style.css">
</head>
<body>
    <header><h1>CASTELLANE AUTO</h1></header>
    <?php require_once("vue/entete.php"); ?>
    <main>
        <?php 
        $page = $_GET['page'] ?? 1;
        switch ($page) {
            case 1 : require_once("vue/public/accueil.php"); break;
            case 3 : $lesvehicules = $unControleur->selectAll_vehicules(); require_once("vue/public/photos.php"); break;
            case 4 : require_once("vue/vue_connexion.php"); break;
            case 5 : 
                $leCandidat = (isset($_GET['action']) && $_GET['action']=='edit') ? $unControleur->selectWhereCandidat($_GET['idcandidat']) : null;
                require_once("vue/admin/vue_insert_candidat.php");
                $lescandidats = $unControleur->selectAll_candidats();
                require_once("vue/admin/vue_select_candidat.php");
                break;
            case 6 : 
                $leMoniteur = (isset($_GET['action']) && $_GET['action']=='edit') ? $unControleur->selectWhereMoniteur($_GET['idmoniteur']) : null;
                require_once("vue/admin/vue_insert_moniteur.php");
                $lesmoniteurs = $unControleur->selectAll_moniteurs();
                require_once("vue/admin/vue_select_moniteur.php");
                break;
            case 7 : 
                $leVehicule = (isset($_GET['action']) && $_GET['action']=='edit') ? $unControleur->selectWhereVehicule($_GET['idvehicule']) : null;
                require_once("vue/admin/vue_insert_vehicule.php");
                $lesvehicules = $unControleur->selectAll_vehicules();
                require_once("vue/admin/vue_select_vehicule.php");
                break;
            case 8 : 
                require_once("vue/admin/vue_insert_cours.php");
                $lescours = $unControleur->selectAll_cours();
                require_once("vue/admin/vue_select_cours.php");
                break;
            case 9 : session_destroy(); header("Location: index.php"); break;
            default : require_once("vue/public/accueil.php"); break;
        }
        ?>
    </main>
</body>
</html>