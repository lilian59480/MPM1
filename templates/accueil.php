<?php

if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=accueil");
    die("");
}
?>

<div id="corps">
    <div class="container">
        <center><h1>Accueil</h1></center>
        <div class="row">
            <?php
            $array = listerJeux();
            foreach ($array as $value) {
                echo '<a class="btn btn-default col-md-5 col-md-offset-1 well well-lg" href="/index.php?view=jeu&jeu=' . protegerAffichage($value["id"]) . '" role="button">
                <h2><small>Jeu ' . protegerAffichage($value["id"]) . ' : </small>' . protegerAffichage($value["nom"]) . '</h2>
                <img class="img-responsive" src="./assets/img/' . protegerAffichage($value["urlimage"]) . '"></img></a>';
            }
            ?>

        </div>



    </div>
</div>
