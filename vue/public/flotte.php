<div class="section">
    <h1 class="section-title">Notre Flotte de Véhicules</h1>
    <p style="color: var(--text-medium); font-size: 1.1rem; margin-bottom: 30px;">
        Des véhicules modernes et récents pour votre apprentissage
    </p>

    <div class="vehicle-grid">
        <?php if(!empty($lesvehicules) && is_array($lesvehicules)): ?>
            <?php foreach($lesvehicules as $vehicule): ?>
                <div class="vehicle-card">
                    <div class="vehicle-image">
                        <svg width="100" height="100" viewBox="0 0 100 100" fill="none">
                            <rect x="20" y="40" width="60" height="30" fill="var(--primary-blue)" rx="5"/>
                            <circle cx="35" cy="75" r="8" fill="var(--text-dark)"/>
                            <circle cx="65" cy="75" r="8" fill="var(--text-dark)"/>
                            <rect x="25" y="35" width="50" height="15" fill="#1E5A96" rx="3"/>
                        </svg>
                    </div>
                    <div class="vehicle-info">
                        <h3><?= htmlspecialchars($vehicule['marque']) ?> <?= htmlspecialchars($vehicule['modele']) ?></h3>
                        <div class="vehicle-plate"><?= htmlspecialchars($vehicule['immatriculation']) ?></div>
                        <div style="margin-top: 15px;">
                            <span class="badge badge-success">Disponible</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card" style="grid-column: 1 / -1; text-align: center; padding: 60px;">
                <p style="color: var(--text-medium); font-size: 1.1rem;">
                    Nos véhicules sont actuellement en cours de maintenance.
                </p>
            </div>
        <?php endif; ?>
    </div>

    <div class="card" style="margin-top: 40px; background: var(--bg-light); border-left-color: var(--accent-salmon);">
        <h3>Véhicules conformes et sécurisés</h3>
        <ul style="margin-top: 15px; padding-left: 20px; color: var(--text-medium); line-height: 2;">
            <li>Contrôle technique à jour</li>
            <li>Entretien régulier par nos mécaniciens agréés</li>
            <li>Équipements de sécurité conformes</li>
            <li>Climatisation et boîtes automatiques disponibles</li>
            <li>Double commande pour votre sécurité</li>
        </ul>
    </div>
</div>