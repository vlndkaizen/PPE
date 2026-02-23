<div class="admin-container">
    <h3 class="admin-title">Mon Planning</h3>

    <p style="margin-bottom: 20px;">
        Bonjour <strong><?= htmlspecialchars($_SESSION['prenom']) ?> <?= htmlspecialchars($_SESSION['nom']) ?></strong>
    </p>

    <table class="elite-table">
        <thead>
            <tr>
                <th>DATE</th>
                <th>HORAIRE</th>
                <th>MONITEUR</th>
                <th>VÉHICULE</th>
                <th>IMMATRICULATION</th>
                <th>STATUT</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($lescours) && is_array($lescours)): ?>
                <?php foreach ($lescours as $cours): ?>
                    <tr>
                        <td>
                            <strong><?= date('d/m/Y', strtotime($cours['date_cours'])) ?></strong>
                        </td>
                        <td>
                            <?= substr($cours['heure_debut'], 0, 5) ?> - <?= substr($cours['heure_fin'], 0, 5) ?>
                        </td>
                        <td><?= htmlspecialchars($cours['nom_moniteur']) ?></td>
                        <td><?= htmlspecialchars($cours['modele_vehicule']) ?></td>
                        <td>
                            <span class="badge">
                                <?= htmlspecialchars($cours['immatriculation']) ?>
                            </span>
                        </td>
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
                        Aucune leçon planifiée pour le moment.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="card" style="margin-top: 30px;">
        <h4>Informations importantes</h4>
        <ul style="margin-top: 15px; padding-left: 20px; line-height: 1.8;">
            <li>Merci de vous présenter 10 minutes avant l'heure de votre leçon</li>
            <li>N'oubliez pas votre pièce d'identité et votre livret d'apprentissage</li>
            <li>En cas d'empêchement, prévenez-nous au moins 48h à l'avance</li>
            <li>Pour toute question, contactez-nous au 04 XX XX XX XX</li>
        </ul>
    </div>
</div>
