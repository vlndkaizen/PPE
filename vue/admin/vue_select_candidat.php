<div class="admin-container">
    <h3 class="admin-title" style="margin-bottom:20px; text-transform:uppercase; letter-spacing:2px;">
        Gestion des Candidats
    </h3>
    
    <table class="elite-table">
        <thead>
            <tr>
                <th style="text-align: center;">ID</th>
                <th>NOM</th>
                <th>PRÉNOM</th>
                <th>EMAIL</th>
                <th>TÉLÉPHONE</th>
                <th style="text-align: center;">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($lescandidats) && is_array($lescandidats)): ?>
                <?php foreach ($lescandidats as $unCandidat): ?>
                    <tr>
                        <td style="text-align: center;"><span class="badge"><?= $unCandidat['idcandidat'] ?></span></td>
                        <td><?= htmlspecialchars($unCandidat['nom']) ?></td>
                        <td><?= htmlspecialchars($unCandidat['prenom']) ?></td>
                        <td><?= htmlspecialchars($unCandidat['email']) ?></td>
                        <td><?= htmlspecialchars($unCandidat['tel']) ?></td>
                        <td style="text-align: center;">
                            <a href="index.php?page=5&action=edit&idcandidat=<?= $unCandidat['idcandidat'] ?>" style="text-decoration: none; border: none;">
                            <img src="image/modifier.png" height="20" title="Modifier" style="cursor: pointer; vertical-align: middle;">
                            </a>
                            <a href="index.php?page=5&action=sup&idcandidat=<?= $unCandidat['idcandidat'] ?>" 
                             onclick="return confirm('Supprimer définitivement ce candidat ?');" 
                             style="margin-left:15px; text-decoration: none; border: none;">
                            <img src="image/supprimer.png" height="20" title="Supprimer" style="cursor: pointer; vertical-align: middle;">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align:center; color:#666; padding:30px;">
                        Aucun candidat enregistré dans la base de données.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>