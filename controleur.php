<?php

session_start();
ob_start();
$addArgs = "";
include_once "libs/Libs.php";
if ($action = valider("action", INPUT_GET, STRING)) {
    switch ($action) {
        case 'Deconexion' :
            session_destroy();
            break;
    }
}

if ($action = valider("action", INPUT_POST, STRING)) {
    switch ($action) {
        case 'Connexion' :
            $pseudo = valider("pseudo", INPUT_POST, STRING);
            $motdepasse = valider("motdepasse", INPUT_POST, STRING);
            if (!empty($pseudo) && !empty($motdepasse)) {
                if (validerUtilisateur($pseudo, $motdepasse)) {
                    $addArgs .= '?e=0';
                } else {
                    $addArgs .= '?e=1';
                }
            } else {
                $addArgs .= '?e=2';
            }
            break;
        case 'Inscription' :
            $pseudo = valider("pseudo", INPUT_POST, STRING);
            $motdepasse = valider("motdepasse", INPUT_POST, STRING);
            $confirmationmotdepasse = valider("confirmationmotdepasse", INPUT_POST, STRING);
            if (!empty($pseudo) && !empty($motdepasse) && !empty($confirmationmotdepasse)) {
                if ($motdepasse === $confirmationmotdepasse) {
                    if (creerUtilisateur($pseudo, $motdepasse)) {
                        $addArgs .= '?e=0';
                    } else {
                        $addArgs .= '?e=3';
                    }
                } else {
                    $addArgs .= '?e=4';
                }
            } else {
                $addArgs .= '?e=2';
            }
            break;

        case 'Score' : $idjoueur = valider("id", INPUT_SESSION);
            $idjeu = valider("idjeu", INPUT_POST, INTEGER);
            $score = valider("inputScore", INPUT_POST, interger);
            $niveau = valider("inputNiveau", INPUT_POST, interger);
            insererScoreweak($idjoueur, $idjeu, $score, $niveau);
            break;
    }
}

$host = valider('HTTP_HOST', INPUT_SERVER, STRING);
$urlBase = rtrim(dirname($_SERVER["PHP_SELF"]), '/\\') . 'index.php';
header("Location:" . $urlBase . $addArgs);
ob_end_clear();
