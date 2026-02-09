<nav class="topbar">
  <div class="topbar-inner">

    <a href="index.php?page=1" class="brand">
      <img src="image/logo.png" alt="Castellane Auto" class="brand-logo">
      <span class="brand-name">Castellane Auto</span>
    </a>

    <ul class="nav-links">
      <!-- Liens publics -->
      <li><a href="index.php?page=1">Accueil</a></li>
      <li><a href="index.php?page=2">Tarifs</a></li>
      <li><a href="index.php?page=3">Flotte</a></li>
      <li><a href="index.php?page=4">Test Code</a></li>
      <li><a href="index.php?page=10" class="nav-cta">Inscription</a></li>

      <!-- Partie Admin -->
      <?php if(isset($_SESSION['email'])): ?>
        <li><a href="index.php?page=5">Candidats</a></li>
        <li><a href="index.php?page=6">Moniteurs</a></li>
        <li><a href="index.php?page=7">Véhicules</a></li>
        <li><a href="index.php?page=8">Planning</a></li>
        <li><a href="index.php?page=9" class="nav-logout">Déconnexion</a></li>
      <?php else: ?>
        <li><a href="index.php?page=99">Espace Admin</a></li>
      <?php endif; ?>
    </ul>

  </div>
</nav>
