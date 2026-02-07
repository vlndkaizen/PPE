<div class="admin-container">
    <h3 class="admin-title">Liste des Moniteurs</h3>
    <table class="elite-table">
        <thead>
            <tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Expérience</th><th>Permis</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($lesmoniteurs as $u) : ?>
                <tr>
                    <td><span class="badge"><?= $u['idmoniteur'] ?></span></td>
                    <td><?= htmlspecialchars($u['nom']) ?></td>
                    <td><?= htmlspecialchars($u['prenom']) ?></td>
                    <td><?= $u['experience'] ?> ans</td>
                    <td><span class="badge-permis"><?= $u['type_permis'] ?></span></td>
                    <td class="actions">
                        <a href="index.php?page=6&action=edit&idmoniteur=<?= $u['idmoniteur'] ?>"><img src="image/modifier.png" height="20"></a>
                        <a href="index.php?page=6&action=sup&idmoniteur=<?= $u['idmoniteur'] ?>" onclick="return confirm('Supprimer ?');"><img src="image/supprimer.png" height="20"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>