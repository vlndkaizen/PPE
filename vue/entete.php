<nav>
    <a href="index.php?page=1">Accueil</a> |
    <a href="index.php?page=2">Nos Tarifs</a> |
    <a href="index.php?page=3">Nos Véhicules</a> |

    <?php if (!isset($_SESSION['email'])) : ?>
        <a href="index.php?page=4">Connexion</a>
    <?php else : ?>
        <a href="index.php?page=5">Candidats</a> |
        <a href="index.php?page=6">Moniteurs</a> |
        <a href="index.php?page=7">Véhicules</a> |
        <a href="index.php?page=8">Planning Cours</a> |
        <a href="index.php?page=9">Déconnexion</a>
    <?php endif; ?>
</nav>
<hr>