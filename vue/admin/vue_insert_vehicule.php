<h3><?php echo ($leVehicule != null) ? "Modification" : "Ajout"; ?> d'un Véhicule</h3>
<form method="post">
    <table>
        <tr><td>Marque</td><td><input type="text" name="marque" value="<?php echo ($leVehicule != null) ? $leVehicule['marque'] : ''; ?>"></td></tr>
        <tr><td>Modèle</td><td><input type="text" name="modele" value="<?php echo ($leVehicule != null) ? $leVehicule['modele'] : ''; ?>"></td></tr>
        <tr><td>Immatriculation</td><td><input type="text" name="immatriculation" value="<?php echo ($leVehicule != null) ? $leVehicule['immatriculation'] : ''; ?>"></td></tr>
        <tr><td>État</td><td>
            <select name="etat">
                <option value="Disponible" <?php echo ($leVehicule != null && $leVehicule['etat'] == 'Disponible') ? 'selected' : ''; ?>>Disponible</option>
                <option value="En réparation" <?php echo ($leVehicule != null && $leVehicule['etat'] == 'En réparation') ? 'selected' : ''; ?>>En réparation</option>
            </select>
        </td></tr>
        <tr>
            <td>
                <?php if ($leVehicule != null) { ?>
                    <input type="hidden" name="idvehicule" value="<?php echo $leVehicule['idvehicule']; ?>">
                    <input type="submit" name="Modifier" value="Enregistrer">
                <?php } else { ?>
                    <input type="submit" name="valider" value="Ajouter">
                <?php } ?>
            </td>
        </tr>
    </table>
</form>