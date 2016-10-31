<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=high");
    die("");
}
?>

<div id="corps">
    <div class="container">

        <h1>Highscore</h1>
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#all" data-toggle="tab">Tous les jeux</a></li>
                <?php
                $listejeu = listerJeux();
                foreach ($listejeu as $value) {
                    echo '<li><a href="#' . protegerAffichage($value["id"]) . '" data-toggle="tab">' . protegerAffichage($value["nom"]) . '</a></li>';
                }
                ?>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <?php
                    $listerscoreall = listerMeilleurScore();
                    mkTable("Test", $listerscoreall, array("Joueur", "Score", "Date", "Jeu"), array("pseudo", "score", "datescore", "nom"));
                    ?>
                </div>
                <?php
                foreach ($listejeu as $value) {
                    echo '<div class="tab-pane" id="' . protegerAffichage($value["id"]) . '">';
                    $listescore = listerMeilleurScoreParJeu($value['id']);
                    mkTable("Test", $listescore, array("Joueur", "Score", "Date", "Jeu"), array("pseudo", "score", "datescore", "nom"));
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
