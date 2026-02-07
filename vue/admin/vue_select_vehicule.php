<div class="admin-container">
    <h3 class="admin-title">Parc Automobile</h3>
    <table class="elite-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Immatriculation</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($lesvehicules) && is_array($lesvehicules)) : ?>
                <?php foreach ($lesvehicules as $unVehicule) : ?>
                    <tr>
                        <td><span class="badge"><?php echo $unVehicule['idvehicule']; ?></span></td>
                        <td><?php echo htmlspecialchars($unVehicule['marque']); ?></td>
                        <td><?php echo htmlspecialchars($unVehicule['modele']); ?></td>
                        <td class="plate"><?php echo htmlspecialchars($unVehicule['immatriculation']); ?></td>
                        <td>
                            <?php 
                                $statut = $unVehicule['etat'] ?? 'Disponible';
                                $color = ($statut == 'Disponible') ? '#00ff00' : '#ff4444';
                                echo "<span style='color:$color'>● $statut</span>";
                            ?>
                        </td>
                        <td class="actions">
                            <a href="index.php?page=7&action=edit&idvehicule=<?php echo $unVehicule['idvehicule']; ?>">
                                <img src="image/modifier.png" height="20">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>