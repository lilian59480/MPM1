<?php

/*
 * Protege l'affichage des donnees sur la page.
 * Elle convertit tous les guillemets et caracteres speciaux HTML5.
 */

function protegerAffichage($string) {
    return htmlentities($string, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8");
}

/*
 * Teste si un utilisateur est connecte, et valide l'accees si c'est le cas.
 */

function acceesSensible($urlerreur, $urlvalide) {
    if (session_status() == PHP_SESSION_DISABLED) {
        ob_end_clean();
        die('<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width, initial-scale=1"><title>Arcade 2i</title><link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/><link rel="stylesheet" type="text/css" href="assets/css/style.css"/><script src="https://code.jquery.com/jquery-2.2.3.min.js"></script><script src="assets/js/bootstrap.js"></script></head><body><div class="container"><div class="row"><div class="alert alert-danger">Il y a une erreur de configuration des sessions</div></div></div></body></html>');
    }
    if (valider("id", INPUT_SESSION) && valider("pseudo", INPUT_SESSION) && valider("derniereconnexion", INPUT_SESSION)) {
        rediriger($urlvalide);
        die();
    }
    rediriger($urlerreur);
    die();
}
