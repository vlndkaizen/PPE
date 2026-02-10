<nav class="topbar">
  <div class="topbar-inner">

    <a href="index.php?page=1" class="brand">
      <img src="image/logo.png" alt="Castellane Auto" class="brand-logo">
      <span class="brand-name">Castellane Auto</span>
    </a>

    <ul class="nav-links">
       
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'candidat'): ?>
        <!-- Menu Candidat -->
        <li><a href="index.php?page=1">Accueil</a></li>
        <li><a href="index.php?page=50">Mon Planning</a></li>
        <li><a href="index.php?page=4">Test Code</a></li>
        <li><a href="index.php?page=9" class="nav-logout">Déconnexion</a></li>
        
      <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
        <!-- Menu Admin -->
        <li><a href="index.php?page=1">Accueil</a></li>
        <li><a href="index.php?page=5">Candidats</a></li>
        <li><a href="index.php?page=6">Moniteurs</a></li>
        <li><a href="index.php?page=7">Véhicules</a></li>
        <li><a href="index.php?page=8">Planning</a></li>
        <li><a href="index.php?page=9" class="nav-logout">Déconnexion</a></li>
        
      <?php else: ?>
        <!-- Menu Public -->
        <li><a href="index.php?page=1">Accueil</a></li>
        <li><a href="index.php?page=2">Nos Tarifs</a></li>
        <li><a href="index.php?page=3">Nos Véhicules</a></li>
        <li><a href="index.php?page=10">Inscription</a></li>
        <li><a href="index.php?page=99">Connexion</a></li>
      <?php endif; ?>
      
    </ul>

  </div>
</nav>