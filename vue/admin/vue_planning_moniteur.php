<div class="admin-container">
    <h3 class="admin-title">Mon Planning Moniteur</h3>
    <p style="margin-bottom: 20px;">
        Bonjour <strong><?= htmlspecialchars($_SESSION['prenom']) ?> <?= htmlspecialchars($_SESSION['nom']) ?></strong>
    </p>

    <table class="elite-table">
        <thead>
            <tr>
                <th>DATE</th>
                <th>HORAIRE</th>
                <th>ÉLÈVE</th>
                <th>TÉLÉPHONE</th>
                <th>VÉHICULE</th>
                <th>STATUT</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($lescours)): ?>
                <?php foreach ($lescours as $cours): ?>
                    <tr>
                        <td><strong><?= date('d/m/Y', strtotime($cours['date_cours'])) ?></strong></td>
                        <td><?= substr($cours['heure_debut'], 0, 5) ?> - <?= substr($cours['heure_fin'], 0, 5) ?></td>
                        <td><?= htmlspecialchars($cours['nom_candidat']) ?></td>
                        <td><?= htmlspecialchars($cours['tel_candidat']) ?></td>
                        <td><?= htmlspecialchars($cours['modele_vehicule']) ?> <span class="badge"><?= htmlspecialchars($cours['immatriculation']) ?></span></td>
                        <td>
                            <?php if ($cours['statut'] == 'Effectué'): ?>
                                <span class="badge" style="background: #7bb27d; color: white;">Effectué</span>
                            <?php else: ?>
                                <span class="badge" style="background: #e78a6d; color: white;">À venir</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: #666;">
                        Aucun cours planifié pour le moment.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>