<div class="form-card">
    <h3 class="admin-title">Planifier une Leçon</h3>
    <form method="post" class="elite-form">
        <div class="form-grid">
            <div class="input-group"><label>Date</label><input type="date" name="date_cours" required></div>
            <div class="input-group"><label>Début</label><input type="time" name="heure_debut" required></div>
            <div class="input-group"><label>Fin</label><input type="time" name="heure_fin" required></div>
            <div class="input-group"><label>ID Candidat</label><input type="number" name="idcandidat" required></div>
            <div class="input-group"><label>ID Moniteur</label><input type="number" name="idmoniteur" required></div>
            <div class="input-group"><label>ID Véhicule</label><input type="number" name="idvehicule" required></div>
        </div>
        <input type="submit" name="planifier" value="Planifier" class="btn-primary">
    </form>
</div>