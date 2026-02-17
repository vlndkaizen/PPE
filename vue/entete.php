<nav class="topbar">
  <div class="topbar-inner">

    <a href="index.php?page=1" class="brand">
      <img src="image/logo.png" alt="Castellane Auto" class="brand-logo">
      <span class="brand-name">Castellane Auto</span>
    </a>

    <ul class="nav-links">
       
      <?php 
      // AJOUT: Déterminer la page active
      $currentPage = $_GET['page'] ?? 1;
      ?>

      <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'candidat'): ?>
        <!-- MENU CANDIDAT -->
        <li><a href="index.php?page=1" class="<?= ($currentPage == 1) ? 'active' : '' ?>">Accueil</a></li>
        <li><a href="index.php?page=3" class="<?= ($currentPage == 3) ? 'active' : '' ?>">Nos Véhicules</a></li>
        <li><a href="index.php?page=50" class="<?= ($currentPage == 50) ? 'active' : '' ?>">Mon Planning</a></li>
        <li><a href="index.php?page=4" class="<?= ($currentPage == 4) ? 'active' : '' ?>">Test Code</a></li>
        <li><a href="index.php?page=9" class="nav-logout">Déconnexion</a></li>
        
      <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'moniteur'): ?>
        <!-- AJOUT: MENU MONITEUR -->
        <li><a href="index.php?page=1" class="<?= ($currentPage == 1) ? 'active' : '' ?>">Accueil</a></li>
        <li><a href="index.php?page=60" class="<?= ($currentPage == 60) ? 'active' : '' ?>">Mon Planning</a></li>
        <li><a href="index.php?page=9" class="nav-logout">Déconnexion</a></li>
        
      <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
        <!-- MENU ADMIN -->
        <li><a href="index.php?page=1" class="<?= ($currentPage == 1) ? 'active' : '' ?>">Accueil</a></li>
        <li><a href="index.php?page=5" class="<?= ($currentPage == 5) ? 'active' : '' ?>">Candidats</a></li>
        <li><a href="index.php?page=6" class="<?= ($currentPage == 6) ? 'active' : '' ?>">Moniteurs</a></li>
        <li><a href="index.php?page=7" class="<?= ($currentPage == 7) ? 'active' : '' ?>">Véhicules</a></li>
        <li><a href="index.php?page=8" class="<?= ($currentPage == 8) ? 'active' : '' ?>">Planning</a></li>
        <li><a href="index.php?page=9" class="nav-logout">Déconnexion</a></li>
        
      <?php else: ?>
        <!-- MENU PUBLIC -->
        <li><a href="index.php?page=1" class="<?= ($currentPage == 1) ? 'active' : '' ?>">Accueil</a></li>
        <li><a href="index.php?page=2" class="<?= ($currentPage == 2) ? 'active' : '' ?>">Nos Tarifs</a></li>
        <li><a href="index.php?page=3" class="<?= ($currentPage == 3) ? 'active' : '' ?>">Nos Véhicules</a></li>
  
        
        <!-- MODIF: Boutons différenciés -->
        <li>
          <a href="index.php?page=10" class="btn-inscription <?= ($currentPage == 10) ? 'active' : '' ?>">
            Inscription
          </a>
        </li>
        <li>
          <a href="index.php?page=99" class="btn-connexion <?= ($currentPage == 99) ? 'active' : '' ?>">
            Connexion
          </a>
        </li>
      <?php endif; ?>
      
    </ul>

  </div>
</nav>