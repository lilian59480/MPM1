<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php");
    die("");
}
?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Arcade 2i</title>
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
        <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-default navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php?view=accueil">Arcade2i</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php?view=accueil">Accueil</a></li>
                        <li><a href="index.php?view=high">Highscores</a></li>
                    </ul>
                    <?php
                    $pseudo = valider("pseudo", INPUT_SESSION);
                    if (valider("id", INPUT_SESSION) && !empty($pseudo) && valider("derniereconnexion", INPUT_SESSION)) {
                        echo '<ul class="nav navbar-nav navbar-right"><li><a href="controleur.php?action=Deconexion">' . protegerAffichage($pseudo) . '<i class="fa fa-sign-out"></i>
</a></li></ul>';
                    } else {
                        echo '<ul class="nav navbar-nav navbar-right"><li><a href="index.php?view=login">Connexion/S\'enregistrer<i class="fa fa-sign-in"></i>
</a></li></ul>';
                    }
                    ?>

                </div>
            </div>
        </nav>
