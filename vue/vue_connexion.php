<div class="form-card" style="max-width: 500px; margin: 60px auto;">
    <h1 class="section-title" style="text-align: center; border: none;">Espace Administrateur</h1>
    <p style="text-align: center; color: var(--text-medium); margin-bottom: 30px;">
        Accès réservé au personnel autorisé
    </p>

    <form method="post" action="index.php?page=99">
        <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Email administrateur</label>
            <input type="email" name="email" required placeholder="admin@castellane.fr">
        </div>

        <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Mot de passe</label>
            <input type="password" name="mdp" required placeholder="••••••••">
        </div>

        <input type="submit" name="Connexion" value="Se connecter">

        <div class="card" style="margin-top: 30px; background: rgba(244, 67, 54, 0.1); border-left-color: var(--danger);">
            <p style="color: var(--danger); font-size: 0.9rem; line-height: 1.6;">
                <strong>Zone sécurisée</strong><br>
                Cet espace est réservé aux administrateurs de Castellane Auto.
            </p>
        </div>

        <p style="text-align: center; margin-top: 25px; color: var(--text-medium);">
            Vous êtes un candidat ? 
            <a href="index.php?page=10" style="color: var(--primary-blue); text-decoration: none; font-weight: 600;">
                Inscrivez-vous ici
            </a>
        </p>
    </form>
</div>