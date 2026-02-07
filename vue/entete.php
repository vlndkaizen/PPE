<nav>
    <ul>
        <li><a href="index.php?page=1">ACCUEIL</a></li>
        <li><a href="index.php?page=2">PACKS & TARIFS</a></li>
        <li><a href="index.php?page=3">FLOTTE VÉHICULES</a></li>

        <?php if (isset($_SESSION['email'])): ?>
            <li><a href="index.php?page=5">CANDIDATS</a></li>
            <li><a href="index.php?page=6">MONITEURS</a></li>
            <li><a href="index.php?page=7">GARAGE</a></li>
            <li><a href="index.php?page=8">PLANNING</a></li>
            <li><a href="index.php?page=9" style="color: #ff4444;">QUITTER</a></li>
        <?php else: ?>
            <li><a href="index.php?page=4">ESPACE CLIENT</a></li>
            <li><a href="index.php?page=10" style="color: #ffcc00; font-weight: bold;">S'INSCRIRE</a></li>
        <?php endif; ?>
    </ul>
</nav>