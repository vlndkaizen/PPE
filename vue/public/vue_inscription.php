<div style="display: flex; justify-content: center; align-items: center; padding: 40px;">
    <form action="" method="post" style="width: 100%; max-width: 500px; background: #1a1a1a; padding: 30px; border-radius: 8px;">
        <h2 style="color: #ffcc00; text-align: center; margin-bottom: 25px; text-transform: uppercase;">Inscription Nouveau Candidat</h2>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
        </div>
        
        <input type="email" name="email" placeholder="Email (ex: jean@mail.com)" required>
        <input type="text" name="tel" placeholder="Téléphone">
        <input type="text" name="adresse" placeholder="Adresse complète">
        
        <div style="margin-top: 15px;">
            <label style="color: #aaa; font-size: 0.9rem;">Êtes-vous étudiant ?</label>
            <select name="est_etudiant">
                <option value="non">Non</option>
                <option value="oui">Oui</option>
            </select>
        </div>

        <input type="text" name="nom_ecole" placeholder="Nom de l'école (si étudiant)">
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 10px;">
            <div>
                <label style="color: #aaa; font-size: 0.8rem;">Date Code prévue</label>
                <input type="date" name="date_code">
            </div>
            <div>
                <label style="color: #aaa; font-size: 0.8rem;">Date Permis prévue</label>
                <input type="date" name="date_permis">
            </div>
        </div>

        <input type="submit" name="Sinscrire" value="REJOINDRE L'ÉCURIE" style="margin-top: 20px; background: #ffcc00; color: #000; font-weight: bold; border: none; padding: 15px; cursor: pointer;">
        
        <p style="text-align: center; margin-top: 15px;">
            <a href="index.php?page=4" style="color: #666; font-size: 0.8rem; text-decoration: none;">Déjà inscrit ? Connectez-vous ici.</a>
        </p>
    </form>
</div>