<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csvFile"])) {
    include './controls/process.php';
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["download"])) {
    include './controls/download.php';
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV and pictures</title>

</head>

<body>
    <h1>Chargement de fichier CSV</h1>
    <p>Après récupération de vos données (comme du webscraping), chargez votre fichier CSV</p>

    <!-- Formulaire pour charger le fichier CSV -->
    <form action="" method="post" enctype="multipart/form-data" onsubmit="showLoadingMessage()">
        <label for="csvFile">Sélectionner un fichier CSV :</label>
        <input type="file" name="csvFile" id="csvFile" accept=".csv">
        <button type="submit">Charger</button>
    </form>

    <!-- Formulaire pour télécharger le dossier ZIP -->
    <form action="" method="post">
        <button id="telechargerBtn" name="download">Télécharger</button>
    </form>

    <a href="https://git.io/typing-svg"><img src="https://readme-typing-svg.herokuapp.com?font=Fira+Code&weight=600&size=19&pause=1000&color=F74736&multiline=true&random=false&width=800&height=100&lines=Attention+un+nouveau+t%C3%A9l%C3%A9chargement+%C3%A9crase++les+images+d%C3%A9j%C3%A0+stock%C3%A9es.;+Veuillez+vider+le+dossier+image+avant+toutes+nouvelles+op%C3%A9rations" alt="Typing SVG" /></a>

    <div id="loadingMessage" style="display: none;">Chargement en cours...</div>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csvFile"])) : ?>
        <?php include './controls/display-results.php'; ?>
    <?php endif; ?>
</body>

<script>
    function showLoadingMessage() {
        document.getElementById('loadingMessage').style.display = 'block';
    }
</script>

</html>