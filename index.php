<?php
session_start();
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

$message = '';
$leCandidat = $leMoniteur = $leVehicule = $leCours = null;
$lescandidats = $lesmoniteurs = $lesvehicules = $lescours = array();

// === FONCTION DE VALIDATION ===
function validerDonnees($data, $isInscription = false) {
    $erreurs = [];

    // NOM : lettres uniquement, min 2 caractères
    if (!empty($data['nom'])) {
        $nom = trim($data['nom']);
        if (strlen($nom) < 2) {
            $erreurs[] = "Le nom doit contenir au moins 2 caractères.";
        } elseif (!preg_match("/^[a-zA-ZÀ-ÿ\s\-']+$/u", $nom)) {
            $erreurs[] = "Le nom ne peut contenir que des lettres.";
        }
    }

    // PRÉNOM : lettres uniquement, min 2 caractères
    if (!empty($data['prenom'])) {
        $prenom = trim($data['prenom']);
        if (strlen($prenom) < 2) {
            $erreurs[] = "Le prénom doit contenir au moins 2 caractères.";
        } elseif (!preg_match("/^[a-zA-ZÀ-ÿ\s\-']+$/u", $prenom)) {
            $erreurs[] = "Le prénom ne peut contenir que des lettres.";
        }
    }

    // EMAIL : format valide
    if (!empty($data['email']) && !filter_var(trim($data['email']), FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'email doit être valide (contenir @ et un domaine comme .fr, .com).";
    }

    // TÉLÉPHONE : min 10 chiffres
    if (!empty($data['tel'])) {
        $tel_propre = preg_replace('/[^0-9]/', '', $data['tel']);
        if (strlen($tel_propre) < 10) {
            $erreurs[] = "Le téléphone doit contenir au moins 10 chiffres.";
        }
        if (!preg_match("/^[0-9\s\-\+\(\)]+$/", $data['tel'])) {
            $erreurs[] = "Le téléphone ne peut contenir que des chiffres, espaces, +, -, (, ).";
        }
    }

    // DATES
    if (!empty($data['date_code']) && !empty($data['date_permis'])) {
        if ($data['date_code'] === $data['date_permis']) {
            $erreurs[] = "La date prévue du code ne peut pas être identique à celle du permis.";
        }
        if (strtotime($data['date_permis']) < strtotime($data['date_code'])) {
            $erreurs[] = "La date du permis doit être postérieure à celle du code.";
        }
    }

    // MOT DE PASSE : obligatoire à l'inscription, avec règles de sécurité
    if ($isInscription) {
        if (empty($data['mdp'])) {
            $erreurs[] = "Le mot de passe est obligatoire.";
        } else {
            if (strlen($data['mdp']) < 8) {
                $erreurs[] = "Le mot de passe doit contenir au moins 8 caractères.";
            }
            if (preg_match('/\s/', $data['mdp'])) {
                $erreurs[] = "Le mot de passe ne peut pas contenir d'espaces.";
            }
            if (!preg_match('/[A-Z]/', $data['mdp'])) {
                $erreurs[] = "Le mot de passe doit contenir au moins une majuscule.";
            }
            if (!preg_match('/[0-9]/', $data['mdp'])) {
                $erreurs[] = "Le mot de passe doit contenir au moins un chiffre.";
            }
        }
        if (!empty($data['mdp']) && !empty($data['mdp2']) && $data['mdp'] !== $data['mdp2']) {
            $erreurs[] = "Les mots de passe ne correspondent pas.";
        }
    }

    // MOT DE PASSE : optionnel en modification, mais si fourni doit respecter les règles
    if (!$isInscription && !empty($data['mdp'])) {
        if (strlen($data['mdp']) < 8) {
            $erreurs[] = "Le mot de passe doit contenir au moins 8 caractères.";
        }
        if (preg_match('/\s/', $data['mdp'])) {
            $erreurs[] = "Le mot de passe ne peut pas contenir d'espaces.";
        }
        if (!preg_match('/[A-Z]/', $data['mdp'])) {
            $erreurs[] = "Le mot de passe doit contenir au moins une majuscule.";
        }
        if (!preg_match('/[0-9]/', $data['mdp'])) {
            $erreurs[] = "Le mot de passe doit contenir au moins un chiffre.";
        }
    }

    return $erreurs;
}

// === CHANGEMENT DE MOT DE PASSE PREMIÈRE CONNEXION ===
if (isset($_POST['changer_mdp_premier'])) {
    if ($_POST['nouveau_mdp'] !== $_POST['nouveau_mdp2']) {
        $message = '<div class="alert alert-error">❌ Les mots de passe ne correspondent pas.</div>';
    } elseif (strlen($_POST['nouveau_mdp']) < 8) {
        $message = '<div class="alert alert-error">❌ Le mot de passe doit contenir au moins 8 caractères.</div>';
    } else {
        // Mise à jour du mot de passe + premier_connexion = 0
        $unControleur->changerMotDePassePremierConnexion($_SESSION['idcandidat'], $_POST['nouveau_mdp']);
        $_SESSION['premier_connexion'] = 0;
        $message = '<div class="alert alert-success">✅ Mot de passe modifié avec succès !</div>';
        header("Location: index.php?page=50");
        exit();
    }
}

// === CONNEXION ===
if (isset($_POST['Connexion'])) {
    $user = $unControleur->verifConnexion($_POST['email'], $_POST['mdp']);
    if ($user) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['role'] = 'admin';
        header("Location: index.php?page=5");
        exit();
    }
    
    $candidat = $unControleur->verifConnexionCandidat($_POST['email'], $_POST['mdp']);
    if ($candidat) {
        $_SESSION['email'] = $candidat['email'];
        $_SESSION['nom'] = $candidat['nom'];
        $_SESSION['prenom'] = $candidat['prenom'];
        $_SESSION['idcandidat'] = $candidat['idcandidat'];
        $_SESSION['role'] = 'candidat';
        $_SESSION['date_prevue_code'] = $candidat['date_prevue_code'];
        $_SESSION['date_prevue_permis'] = $candidat['date_prevue_permis'];
        // AJOUT: Stocker si première connexion
        $_SESSION['premier_connexion'] = $candidat['premier_connexion'];
        
        // AJOUT: Redirection vers changement MDP si première connexion
        if ($candidat['premier_connexion'] == 1) {
            header("Location: index.php?page=52"); // Page changement MDP
            exit();
        }
        
        header("Location: index.php?page=50");
        exit();
    }
    
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
    $erreurs = validerDonnees($_POST, true);
    
    if (empty($erreurs)) {
        try {
            // MODIF: Inscription par candidat = premier_connexion à 0
            $_POST['premier_connexion'] = 0;
            $unControleur->insert_candidat($_POST);
            $message = '<div class="alert alert-success">✅ Inscription réussie ! Nous vous contacterons sous 24h.</div>';
        } catch (Exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false || strpos($e->getMessage(), '1062') !== false) {
                $message = '<div class="alert alert-error">❌ Cet email est déjà utilisé.</div>';
            } else {
                $message = '<div class="alert alert-error">❌ Erreur lors de l\'inscription.</div>';
            }
        }
    } else {
        $message = '<div class="alert alert-error">❌ ' . implode('<br>', $erreurs) . '</div>';
    }
}

// === GESTION ADMIN ===
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    
    if (isset($_POST['valider'])) {
        $erreurs = validerDonnees($_POST, true);
        if (empty($erreurs)) {
            try {
                // AJOUT: Admin ajoute candidat = premier_connexion à 1
                $_POST['premier_connexion'] = 1;
                $unControleur->insert_candidat($_POST);
                header("Location: index.php?page=5");
                exit();
            } catch (Exception $e) {
                $message = '<div class="alert alert-error">❌ Cet email existe déjà.</div>';
            }
        } else {
            $message = '<div class="alert alert-error">❌ ' . implode('<br>', $erreurs) . '</div>';
        }
    }
    
    if (isset($_POST['Modifier'])) {
        $erreurs = validerDonnees($_POST);
        if (empty($erreurs)) {
            $unControleur->update_candidat($_POST);
            header("Location: index.php?page=5");
            exit();
        } else {
            $message = '<div class="alert alert-error">❌ ' . implode('<br>', $erreurs) . '</div>';
        }
    }
    
    if (isset($_GET['action']) && $_GET['action'] == 'sup' && isset($_GET['idcandidat'])) {
        $unControleur->delete_candidat($_GET['idcandidat']);
        header("Location: index.php?page=5");
        exit();
    }

    if (isset($_POST['valider_moniteur'])) {
        $erreurs = validerDonnees($_POST);
        if (empty($erreurs)) {
            try {
                $unControleur->insert_moniteur($_POST);
                header("Location: index.php?page=6");
                exit();
            } catch (Exception $e) {
                $message = '<div class="alert alert-error">❌ Cet email existe déjà.</div>';
            }
        } else {
            $message = '<div class="alert alert-error">❌ ' . implode('<br>', $erreurs) . '</div>';
        }
    }
    
    if (isset($_POST['ModifierMoniteur'])) {
        $erreurs = validerDonnees($_POST);
        if (empty($erreurs)) {
            $unControleur->update_moniteur($_POST);
            header("Location: index.php?page=6");
            exit();
        } else {
            $message = '<div class="alert alert-error">❌ ' . implode('<br>', $erreurs) . '</div>';
        }
    }
    
    if (isset($_GET['action']) && $_GET['action'] == 'supMoniteur' && isset($_GET['idmoniteur'])) {
        $unControleur->delete_moniteur($_GET['idmoniteur']);
        header("Location: index.php?page=6");
        exit();
    }

    if (isset($_POST['valider_vehicule'])) {
        $imageName = 'default-car.jpg';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];
            $filename = $_FILES['image']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if (in_array($ext, $allowed) && $_FILES['image']['size'] <= 5000000) {
                $imageName = uniqid() . '.' . $ext;
                if (!is_dir('uploads/vehicules')) {
                    mkdir('uploads/vehicules', 0777, true);
                }
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/vehicules/' . $imageName);
            }
        }
        $_POST['image'] = $imageName;
        $unControleur->insert_vehicule($_POST);
        header("Location: index.php?page=7");
        exit();
    }
    
    if (isset($_POST['ModifierVehicule'])) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];
            $filename = $_FILES['image']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if (in_array($ext, $allowed) && $_FILES['image']['size'] <= 5000000) {
                $imageName = uniqid() . '.' . $ext;
                if (!is_dir('uploads/vehicules')) {
                    mkdir('uploads/vehicules', 0777, true);
                }
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/vehicules/' . $imageName);
                $_POST['image'] = $imageName;
            }
        } else {
            $vehicule = $unControleur->selectWhere_vehicule($_POST['idvehicule']);
            $_POST['image'] = $vehicule['image'];
        }
        $unControleur->update_vehicule($_POST);
        header("Location: index.php?page=7");
        exit();
    }
    
    if (isset($_GET['action']) && $_GET['action'] == 'supVehicule' && isset($_GET['idvehicule'])) {
        $unControleur->delete_vehicule($_GET['idvehicule']);
        header("Location: index.php?page=7");
        exit();
    }

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

<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'candidat' && $_SESSION['premier_connexion'] == 0): ?>
    <div style="background: linear-gradient(135deg, #0F4C81 0%, #0F4C81 100%); color: white; padding: 15px 20px; text-align: center; font-weight: 600;">
        Dates prévues : 
        <span style="margin: 0 20px;">
            Code : <?= !empty($_SESSION['date_prevue_code']) ? date('d/m/Y', strtotime($_SESSION['date_prevue_code'])) : 'Non définie' ?>
        </span>
        <span>
            Permis : <?= !empty($_SESSION['date_prevue_permis']) ? date('d/m/Y', strtotime($_SESSION['date_prevue_permis'])) : 'Non définie' ?>
        </span>
    </div>
<?php endif; ?>

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
        case 99: include("vue/vue_connexion.php"); break;

        case 50:
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'candidat') {
                // AJOUT: Bloquer si première connexion non terminée
                if ($_SESSION['premier_connexion'] == 1) {
                    header("Location: index.php?page=52");
                    exit();
                }
                $lescours = $unControleur->selectCours_byCandidat($_SESSION['idcandidat']);
                $nbRestants = $unControleur->countCoursRestants($_SESSION['idcandidat']);
                include("vue/admin/vue_planning_candidat.php");
            } else {
                header("Location: index.php?page=99");
                exit();
            }
            break;

        case 51:
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'candidat') {
                // AJOUT: Bloquer si première connexion
                if ($_SESSION['premier_connexion'] == 1) {
                    header("Location: index.php?page=52");
                    exit();
                }
                $lesvehicules = $unControleur->selectAll_vehicules();
                include("vue/candidat/vue_vehicules_candidat.php");
            } else {
                header("Location: index.php?page=99");
                exit();
            }
            break;

        // AJOUT: Page changement mot de passe première connexion
        case 52:
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'candidat' && $_SESSION['premier_connexion'] == 1) {
                include("vue/candidat/changement_mdp_premier.php");
            } else {
                header("Location: index.php?page=50");
                exit();
            }
            break;

        case 60:
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'moniteur') {
                $lescours = $unControleur->selectCours_byMoniteur($_SESSION['idmoniteur']);
                include("vue/admin/vue_planning_moniteur.php");
            } else {
                header("Location: index.php?page=99");
                exit();
            }
            break;

        case 5:
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

        case 6:
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

        case 7:
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

        case 8:
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

<?php 
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    include("vue/public/footer.php");
}
?>

</body>
</html>