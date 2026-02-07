<h3>Planning des Leçons</h3>
<table border="1">
    <tr>
        <th>Date</th><th>Début</th><th>Fin</th><th>État</th><th>Candidat</th><th>Moniteur</th><th>Véhicule</th>
    </tr>
    <?php 
    $lescours = $unControleur->selectAll_cours(); 
    foreach ($lescours as $unCours) { ?>
    <tr>
        <td><?php echo $unCours['date_cours']; ?></td>
        <td><?php echo $unCours['heure_debut']; ?></td>
        <td><?php echo $unCours['heure_fin']; ?></td>
        <td><?php echo $unCours['etat']; ?></td>
        <td><?php echo $unCours['nom_candidat']; ?></td>
        <td><?php echo $unCours['nom_moniteur']; ?></td>
        <td><?php echo $unCours['modele_vehicule']; ?></td>
    </tr>
    <?php } ?>
</table>