<div class="form-card">
    <h3 class="admin-title"><?php echo ($leVehicule != null) ? "Modification" : "Ajout"; ?> Véhicule</h3>

    <form method="post" class="elite-form">
        <div class="form-grid">
            <div class="input-group">
                <label>Marque</label>
                <input type="text" name="marque"
                       value="<?php echo ($leVehicule != null) ? htmlspecialchars($leVehicule['marque']) : ''; ?>"
                       required>
            </div>

            <div class="input-group">
                <label>Modèle</label>
                <input type="text" name="modele"
                       value="<?php echo ($leVehicule != null) ? htmlspecialchars($leVehicule['modele']) : ''; ?>"
                       required>
            </div>

            <div class="input-group">
                <label>Immatriculation</label>
                <input type="text" name="immatriculation"
                       value="<?php echo ($leVehicule != null) ? htmlspecialchars($leVehicule['immatriculation']) : ''; ?>"
                       required>
            </div>

            <div class="input-group">
                <label>État</label>
                <select name="etat" required>
                    <option value="Disponible" <?php echo ($leVehicule != null && $leVehicule['etat'] == 'Disponible') ? 'selected' : ''; ?>>
                        Disponible
                    </option>
                    <option value="En réparation" <?php echo ($leVehicule != null && $leVehicule['etat'] == 'En réparation') ? 'selected' : ''; ?>>
                        En réparation
                    </option>
                </select>
            </div>
        </div>

        <div class="form-btns">
            <?php if ($leVehicule != null): ?>
                <input type="hidden" name="idvehicule" value="<?php echo $leVehicule['idvehicule']; ?>">
                <input type="submit" name="ModifierVehicule" value="Enregistrer" class="btn-primary">
            <?php else: ?>
                <input type="submit" name="valider_vehicule" value="Ajouter" class="btn-primary">
            <?php endif; ?>
        </div>
    </form>
</div>
