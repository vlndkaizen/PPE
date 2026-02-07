<?php
    session_start();
    require_once("controleur/controleur.class.php");
    $unControleur = new Controleur();

    // Initialisation pour éviter les erreurs orange
    $leCandidat = $leMoniteur = $leVehicule = null;
    $lescandidats = $lesmoniteurs = $lesvehicules = $lescours = array();

    // --- TRAITEMENT CONNEXION ---
    if (isset($_POST['Connexion'])) {
        $user = $unControleur->verifConnexion($_POST['email'], $_POST['mdp']);
        if ($user) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['nom'] = $user['nom'];
        }
    }

    // --- TRAITEMENT INSCRIPTION (Public) ---
    if (isset($_POST['Sinscrire'])) {
        // On utilise la fonction existante du contrôleur
        $unControleur->insert_candidat($_POST);
        echo "<script>alert('Inscription validée ! Bienvenue chez Castellane Auto.');</script>";
    }

    // --- ACTIONS ADMIN ---
    if (isset($_SESSION['email'])) {
        if (isset($_POST['valider'])) { $unControleur->insert_candidat($_POST); }
        if (isset($_POST['Modifier'])) { $unControleur->update_candidat($_POST); }
        if (isset($_GET['action']) && $_GET['action'] == 'sup' && isset($_GET['idcandidat'])) {
            $unControleur->delete_candidat($_GET['idcandidat']);
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Castellane Auto | Elite</title>
    <link rel="stylesheet" type="text/css" href="design/style.css?v=<?= time(); ?>">
</head>
<body>

<header><h1>CASTELLANE AUTO</h1></header>

<?php if(file_exists("vue/entete.php")) include("vue/entete.php"); ?>

<main>
    <?php
    $page = $_GET['page'] ?? 1;

    switch ($page) {
        case 1: include("vue/public/accueil.php"); break;
        case 2: include("vue/public/tarifs.php"); break;
        case 3: 
            $lesvehicules = $unControleur->selectAll_vehicules(); 
            include("vue/public/photos.php"); 
            break;
        case 4: include("vue/vue_connexion.php"); break;
        
        // PAGE INSCRIPTION
        case 10: include("vue/public/vue_inscription.php"); break;

        case 5: // Candidats (Admin)
            if (isset($_SESSION['email'])) {
                if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                    $leCandidat = $unControleur->selectWhere_candidat($_GET['idcandidat']);
                }
                include("vue/admin/vue_insert_candidat.php");
                $lescandidats = $unControleur->selectAll_candidats();
                include("vue/admin/vue_select_candidat.php");
            } else { header("Location: index.php?page=4"); }
            break;

        case 6: // Moniteurs
            if (isset($_SESSION['email'])) {
                $lesmoniteurs = $unControleur->selectAll_moniteurs();
                include("vue/admin/vue_select_moniteur.php");
            } break;

        case 7: // Véhicules
            if (isset($_SESSION['email'])) {
                $lesvehicules = $unControleur->selectAll_vehicules();
                include("vue/admin/vue_select_vehicule.php");
            } break;

        case 9: session_destroy(); header("Location: index.php"); break;
        default: include("vue/public/accueil.php"); break;
    }
    ?>
</main>
</body>
</html>