<div class="form-card">
    <h3 class="admin-title"><?php echo ($leMoniteur != null) ? "Modification" : "Ajout"; ?> Moniteur</h3>
    <form method="post" class="elite-form">
        <div class="form-grid">
            <div class="input-group"><label>Nom</label><input type="text" name="nom" value="<?= $leMoniteur['nom'] ?? '' ?>" required></div>
            <div class="input-group"><label>Prénom</label><input type="text" name="prenom" value="<?= $leMoniteur['prenom'] ?? '' ?>" required></div>
            <div class="input-group"><label>Tél</label><input type="text" name="tel" value="<?= $leMoniteur['tel'] ?? '' ?>"></div>
            <div class="input-group"><label>Expérience (ans)</label><input type="number" name="experience" value="<?= $leMoniteur['experience'] ?? '' ?>"></div>
            <div class="input-group">
                <label>Permis</label>
                <select name="type_permis">
                    <option value="B" <?= ($leMoniteur && $leMoniteur['type_permis']=='B')?'selected':'' ?>>Permis B</option>
                    <option value="A" <?= ($leMoniteur && $leMoniteur['type_permis']=='A')?'selected':'' ?>>Permis A</option>
                </select>
            </div>
        </div>
        <div class="form-btns">
            <?php if($leMoniteur): ?>
                <input type="hidden" name="idmoniteur" value="<?= $leMoniteur['idmoniteur'] ?>">
                <input type="submit" name="ModifierMoniteur" value="Enregistrer" class="btn-primary">
            <?php else: ?>
                <input type="submit" name="valider_moniteur" value="Ajouter" class="btn-primary">
            <?php endif; ?>
        </div>
    </form>
</div>