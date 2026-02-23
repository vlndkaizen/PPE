<div class="admin-container">
    <h3 class="admin-title">Gestion des Moniteurs</h3>
    
    <table class="elite-table">
        <thead>
            <tr>
                <th style="text-align: center;">ID</th>
                <th>NOM</th>
                <th>PRÉNOM</th>
                <th>EMAIL</th>
                <th>TÉLÉPHONE</th>
                <th style="text-align: center;">PERMIS</th>
                <th style="text-align: center;">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($lesmoniteurs) && is_array($lesmoniteurs)): ?>
                <?php foreach ($lesmoniteurs as $unMoniteur): ?>
                    <tr>
                        <td style="text-align: center;"><span class="badge"><?= $unMoniteur['idmoniteur'] ?></span></td>
                        <td><?= htmlspecialchars($unMoniteur['nom']) ?></td>
                        <td><?= htmlspecialchars($unMoniteur['prenom']) ?></td>
                        <td><?= htmlspecialchars($unMoniteur['email']) ?></td>
                        <td><?= htmlspecialchars($unMoniteur['tel']) ?></td>
                        <td style="text-align: center;">
                            <span class="badge" style="background: #bbb7b6;"><?= $unMoniteur['type_permis'] ?></span>
                        </td>
                        <td style="text-align: center;">
                        <a href="index.php?page=6&action=editMoniteur&idmoniteur=<?= $unMoniteur['idmoniteur'] ?>" 
                        style="text-decoration: none; border: none;">
                        <img src="image/modifier.png" height="20" title="Modifier" style="cursor: pointer; vertical-align: middle;">
                        </a>
                        <a href="index.php?page=6&action=supMoniteur&idmoniteur=<?= $unMoniteur['idmoniteur'] ?>" 
                        onclick="return confirm('Supprimer définitivement ce moniteur ?');" 
                        style="margin-left:15px; text-decoration: none; border: none;">
                        <img src="image/supprimer.png" height="20" title="Supprimer" style="cursor: pointer; vertical-align: middle;">
                        </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align:center; color:#666; padding:30px;">
                        Aucun moniteur enregistré.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>