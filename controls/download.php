<?php
// Définissez le type de contenu en ZIP
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="images.zip"');

// Créez un fichier ZIP contenant le contenu du dossier 'image'
$zip = new ZipArchive();
$zipFileName = 'images.zip';

if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    // Ajoutez tous les fichiers du dossier 'image' à l'archive ZIP
    $imageDirectory = 'image/';
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($imageDirectory),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        if (!$file->isDir()) {
            $cheminFichier = $file->getRealPath();
            $cheminRelatif = basename($cheminFichier);
            $zip->addFile($cheminFichier, $cheminRelatif);
        }
    }

    // Fermez le fichier ZIP
    $zip->close();

    // Envoyez le fichier ZIP au navigateur
    readfile($zipFileName);

    // Supprimez le fichier ZIP temporaire
    unlink($zipFileName);
} else {
    echo 'Échec de la création du fichier ZIP';
}
