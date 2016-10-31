<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=login");
    die("");
}
?>

<div id="corps">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <center><h2>Connexion</h2>
                    <br>
                    <?php
                    mkForm("POST", "controleur.php");
                    mkInput("text", "pseudo", "Pseudo", true);
                    mkInput("password", "motdepasse", "Mot de Passe", true);
                    mkSubmit("Connexion");
                    endForm();
                    ?>
                </center>
            </div>
            <div class="col-md-6">
                <center><h2>S'enregistrer</h2>
                    <br>
                    <?php
                    mkForm("POST", "controleur.php");
                    mkInput("text", "pseudo", "Pseudo", true);
                    mkInput("password", "motdepasse", "Mot de Passe", true);
                    mkInput("password", "confirmationmotdepasse", "Confirmation du Mot de Passe", true);
                    mkSubmit("Inscription");
                    endForm();
                    ?>
                </center>
            </div>
        </div>
    </div>
</div>
