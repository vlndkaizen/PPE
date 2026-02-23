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
                                $color = ($statut == 'Disponible') ? '#5dcd5d' : '#ff4444';
                                echo "<span style='color:" . htmlspecialchars($color, ENT_QUOTES) . "'>● " . htmlspecialchars($statut, ENT_QUOTES, 'UTF-8') . "</span>";
                            ?>
                        </td>
                        
                           
                             
                        <td style="text-align: center;">
                            <a href="index.php?page=7&action=editVehicule&idvehicule=<?= $unVehicule['idvehicule'] ?>" 
                               style="text-decoration: none; border: none;">
                                <img src="image/modifier.png" height="20" title="Modifier" style="cursor: pointer; vertical-align: middle;">
                            </a>
                            <a href="index.php?page=7&action=supVehicule&idvehicule=<?= $unVehicule['idvehicule'] ?>" 
                               onclick="return confirm('Supprimer définitivement ce véhicule ?');" 
                               style="margin-left:15px; text-decoration: none; border: none;">
                                <img src="image/supprimer.png" height="20" title="Supprimer" style="cursor: pointer; vertical-align: middle;">
                            </a>
                        </td>   

                        
                </td>
                

                        
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>