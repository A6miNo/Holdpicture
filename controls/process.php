<?php
// Vérifie si le fichier a bien été téléchargé sans erreurs
if ($_FILES["csvFile"]["error"] == 0) {
    // Chemin temporaire du fichier téléchargé
    $tmpFilePath = $_FILES["csvFile"]["tmp_name"];

    // Déplace le fichier téléchargé vers un emplacement permanent
    $csvFilePath = "uploads/" . $_FILES["csvFile"]["name"];
    move_uploaded_file($tmpFilePath, $csvFilePath);

    // Ouvrir le fichier CSV en lecture
    $csvFile = fopen($csvFilePath, 'r');

    if ($csvFile !== false) {
        $counter = 1; // Initialise un compteur pour les images
        $imageDirectory = 'image/'; // Dossier où vous souhaitez enregistrer les images

        if (!file_exists($imageDirectory)) {
            mkdir($imageDirectory, 0777, true); // Crée le dossier s'il n'existe pas
        }

        // Tableau pour stocker les résultats
        $results = array();

        // Parcourir le fichier ligne par ligne
        while (($line = fgets($csvFile)) !== false) {
            // Extraction de l'URL contenant "cdn"
            if (preg_match('/"([^"]*cdn[^"]*)"/', $line, $matches)) {
                $cdnUrl = $matches[1]; // Récupère l'URL contenant "cdn"
                $results[] = array(
                    'cdnUrl' => $cdnUrl,
                    'status' => ''
                );

                // Téléchargement de l'image
                $imageData = file_get_contents($cdnUrl);

                if ($imageData !== false) {
                    // Construit le chemin complet du fichier local
                    $localFilename = $imageDirectory . 'image' . $counter . '.png';

                    // Incrémente le compteur pour le prochain fichier
                    $counter++;

                    // Enregistre l'image localement
                    if (file_put_contents($localFilename, $imageData) !== false) {
                        $results[count($results) - 1]['status'] = 'Téléchargement réussi : ' . $localFilename;
                    } else {
                        $results[count($results) - 1]['status'] = 'Échec de l\'enregistrement de l\'image localement.';
                    }
                } else {
                    $results[count($results) - 1]['status'] = 'Échec du téléchargement de l\'image depuis l\'URL : ' . $cdnUrl;
                }
            }
        }

        // Fermer le fichier
        fclose($csvFile);
    } else {
        echo "Erreur lors de l'ouverture du fichier CSV." . PHP_EOL;
    }
} else {
    echo "Erreur lors du téléchargement du fichier CSV." . PHP_EOL;
}
