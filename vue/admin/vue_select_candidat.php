<div class="admin-container">
    <h3 class="admin-title">Liste des Candidats</h3>
    <table class="elite-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Date Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($lescandidats) && is_array($lescandidats)) : ?>
                <?php foreach ($lescandidats as $unCandidat) : ?>
                    <tr>
                        <td><span class="badge"><?php echo $unCandidat['idcandidat']; ?></span></td>
                        <td><?php echo htmlspecialchars($unCandidat['nom']); ?></td>
                        <td><?php echo htmlspecialchars($unCandidat['prenom']); ?></td>
                        <td><?php echo (!empty($unCandidat['email'])) ? htmlspecialchars($unCandidat['email']) : '-'; ?></td>
                        <td>
                            <?php 
                                if (!empty($unCandidat['date_prevue_code'])) {
                                    echo date('d/m/Y', strtotime($unCandidat['date_prevue_code']));
                                } else {
                                    echo '<span class="text-dim">Non fixée</span>';
                                }
                            ?>
                        </td>
                        <td class="actions">
                            <a href="index.php?page=5&action=edit&idcandidat=<?php echo $unCandidat['idcandidat']; ?>" title="Modifier">
                                <img src="image/modifier.png" height="20">
                            </a>
                            <a href="index.php?page=5&action=sup&idcandidat=<?php echo $unCandidat['idcandidat']; ?>" 
                               onclick="return confirm('Supprimer ce candidat ?');" title="Supprimer">
                                <img src="image/supprimer.png" height="20">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="6">Aucun candidat trouvé.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>