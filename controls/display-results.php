<?php if (count($results) > 0) : ?>
    <h2>Résultats du Traitement :</h2>
    <table border="1">
        <thead>
            <tr>
                <th>URL contenant CDN</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $result) : ?>
                <tr>
                    <td><?php echo $result['cdnUrl']; ?></td>
                    <td><?php echo $result['status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>Aucun résultat à afficher.</p>
<?php endif; ?>