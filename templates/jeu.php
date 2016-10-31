<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=jeu");
    die("");
}

$idjeu = valider('jeu', INPUT_GET, INTEGER);

if (!verifierJeuxExistant($idjeu)) {
    header("Location:../index.php?view=accueil");
    die("");
}

$array = infoJeu($idjeu);

echo '<div id="corps">
      <div class="container"><h1>' . protegerAffichage($array["nom"]) . '</h1>'
 . '<div id="divjeu" class="row well well-sm">';
?>
<img id="menu" src="./assets/img/menu.png" onclick="jouer()"></img>
<p id="score" style="display: none;"> Score : <span id="actuscore">0</span>&nbsp;Niveau : <span id="actuniveau">1</span></p>
<canvas id="jeu"></canvas>

<div id="gm" style="width: 960px; height: 640px; border: 1px solid black; background-color: black; padding: 30px;"><h2 style="text-align: center; margin: 30px; font-size: xx-large;">GAME OVER</h2>
    <h3 style="text-align: center; margin: 30px">Valider votre score :</h3>
    <form class="form-horizontal" action="" method="POST">
        <div class="form-group">
            <label for="inputScore" class="col-sm-2 control-label">Score</label>
            <div class="col-sm-10">
                <input class="form-control" id="inputScore" type="number" value="0" readonly>
            </div>
        </div>
        <input type="hidden" class="form-control" id="inputNiveau" value="1">
        <input type="hidden" class="form-control" id="inputElementssuprime" value="*elementssuprime*">

        <?php
        echo '<input type="hidden" class="form-control" id="idjeu" value="' . $idjeu . '">';
        if (!(valider("id", INPUT_SESSION) && !empty($pseudo) && valider("derniereconnexion", INPUT_SESSION))) {
            echo '<p style="font-size: large;">Se connecter :</p><div class = "form-group"><label for="inputPseudo" class="col-sm-2 control-label">Pseudo</label>';
            echo '<div class="col-sm-10"><input type="text" class="form-control" id="inputPseudo" placeholder="Pseudo" required="required"></div></div><div class="form-group">';
            echo '<label for="inputPassword" class="col-sm-2 control-label">Password</label>';
            echo '<div class="col-sm-10"><input type="password" class="form-control" id="inputPassword" placeholder="Password" required="required">';
            echo '</div></div>';
        }
        ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-default" value="Valider">
            </div>
        </div>

    </form>
</div>

<?php
echo '</div>
      <div id="desc" class="row well well-sm"><h4>Description du jeu :</h4><p>' . protegerAffichage($array["description"]) . '</p></div>'
 . '</div></div>';
?>

<script src="assets/js/constantes.js"></script>
<script src="assets/js/Engine/Input.js"></script>
<script src="assets/js/Engine/Image.js"></script>
<script src="assets/js/Objects/Common/Object.js"></script>
<script src="assets/js/Objects/Common/Player.js"></script>
<script src="assets/js/Objects/SpaceInvaders/Ennemi.js"></script>
<script src="assets/js/Objects/SpaceInvaders/Tir.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/Engine/Game.js"></script>
