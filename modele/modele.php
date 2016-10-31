<?php

/*
 * Liste tous les jeux dans la BDD
 */

function listerJeux() {
    return SQLDonnees(SQLExecuterRequete("SELECT * FROM T_Jeu", array()));
}

/*
 * Donne les informations sur 1 jeu
 */

function infoJeu($idjeu) {
    return SQLDonnees(SQLExecuterRequete("SELECT * FROM T_Jeu WHERE id = :id", array("id" => $idjeu)))[0];
}

/*
 * Verifie si un jeu existe, afin de ne pas lancer un jeu qui n'existe pas :)
 */

function verifierJeuxExistant($id) {
    if (!empty(SQLDonnees(SQLExecuterRequete("SELECT * FROM T_Jeu WHERE id = :id", array("id" => $id))))) {
        return true;
    } else {
        return false;
    }
}

/*
 * Liste les meilleurs score pour tous les jeux.
 * Les parametres sont:
 * $idjoueur qui permet d'afficher les meilleurs scores d'un joueur precis
 * $limit qui renvoit le nombre de score a recuperer
 */

function listerMeilleurScore($idjoueur = -1, $limit = 5) {
    if ($idjoueur < 0) {
        return SQLDonnees(SQLExecuterRequete("SELECT * FROM T_Score INNER JOIN T_Jeu ON T_Score.idjeu = T_Jeu.id INNER JOIN T_Utilisateur ON T_Score.idpseudo = T_Utilisateur.id ORDER BY score DESC LIMIT 0,:limit", array("limit" => $limit)));
    } else {
        return SQLDonnees(SQLExecuterRequete("SELECT * FROM T_Score INNER JOIN T_Jeu ON T_Score.idjeu = T_Jeu.id INNER JOIN T_Utilisateur ON T_Score.idpseudo = T_Utilisateur.id ORDER BY score DESC LIMIT 0,:limit", array("idjoueur" => $idjoueur, "limit" => $limit)));
    }
}

/*
 * Liste les meilleurs score pour un jeu precis.
 * Les parametres sont:
 * $idjeu qui permet de choisir le jeu
 * $idjoueur qui permet d'afficher les meilleurs scores d'un joueur precis
 * $limit qui renvoit le nombre de score a recuperer
 */

function listerMeilleurScoreParJeu($idjeu, $idjoueur = -1, $limit = 5) {
    if ($idjoueur < 0) {
        return SQLDonnees(SQLExecuterRequete("SELECT * FROM T_Score INNER JOIN T_Jeu ON T_Score.idjeu = T_Jeu.id INNER JOIN T_Utilisateur ON T_Score.idpseudo = T_Utilisateur.id WHERE idjeu = :idjeu ORDER BY score DESC LIMIT 0,:limit", array("idjeu" => $idjeu, "limit" => $limit)));
    } else {
        return SQLDonnees(SQLExecuterRequete("SELECT * FROM T_Score INNER JOIN T_Jeu ON T_Score.idjeu = T_Jeu.id INNER JOIN T_Utilisateur ON T_Score.idpseudo = T_Utilisateur.id WHERE idpseudo = :idjoueur AND idjeu = :idjeu ORDER BY score DESC LIMIT 0,:limit", array("idjeu" => $idjeu, "idjoueur" => $idjoueur, "limit" => $limit)));
    }
}

/*
 * Valide un utilisateur. Doit etre utilise avant l' accede a des parties sensible afin de pouvoir y aller
 */

function validerUtilisateur($pseudo, $motdepasse) {
    if (session_status() == PHP_SESSION_DISABLED) {
        ob_end_clean();
        die('<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width, initial-scale=1"><title>Arcade 2i</title><link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/><link rel="stylesheet" type="text/css" href="assets/css/style.css"/><script src="https://code.jquery.com/jquery-2.2.3.min.js"></script><script src="assets/js/bootstrap.js"></script></head><body><div class="container"><div class="row"><div class="alert alert-danger">Il y a une erreur de configuration des sessions</div></div></div></body></html>');
    }
    $_SESSION["id"] = null;
    $_SESSION["pseudo"] = null;
    $_SESSION["derniereconnexion"] = null;
    $utilisateurBdd = recupererUtilisateurParpseudo($pseudo);
    if ($utilisateurBdd["motdepasse"] === md5($motdepasse)) {
        connecterUtilisateur($utilisateurBdd["id"]);
        $_SESSION["id"] = $utilisateurBdd["id"];
        $_SESSION["pseudo"] = $utilisateurBdd["pseudo"];
        $_SESSION["derniereconnexion"] = $utilisateurBdd["derniereconnexion"];
        return true;
    }
    return false;
}

/*
 * Recupere les informations sur un joueur precis
 */

function recupererUtilisateurParpseudo($pseudo) {
    $donnees = SQLDonnees(SQLExecuterRequete("SELECT * FROM T_Utilisateur WHERE pseudo = :pseudo", array("pseudo" => $pseudo)));
    if (count($donnees) !== 1) {
        return false;
    }
    return $donnees[0];
}

/*
 * Creer un utilisateur dans la BDD
 */

function creerUtilisateur($pseudo, $motdepasse) {
    if (!recupererUtilisateurParpseudo($pseudo)) {
        SQLExecuterRequete("INSERT INTO T_Utilisateur VALUES (NULL,:pseudo,:motdepasse,NOW())", array("pseudo" => $pseudo, "motdepasse" => md5($motdepasse)));
        validerUtilisateur($pseudo, $motdepasse);
        return true;
    }
    return false;
}

/*
 * Connecte un utilisateur dans la BDD
 */

function connecterUtilisateur($idUtilisateur) {
    SQLExecuterRequete("UPDATE T_Utilisateur SET derniereconnexion = NOW() WHERE id = :id;", array("id" => $idUtilisateur));
}

/*
 * Change le mot de passe d'un utilisateur
 */

function changerMotDePasse($idUtilisateur, $motdepasse) {
    SQLExecuterRequete("UPDATE T_Utilisateur SET motdepasse=:motdepasse WHERE id = :id", array("id" => $idUtilisateur, "motdepasse" => md5($motdepasse)));
}

/*
 * TODO : Faire cete fonction qui valide les scores recus
 */

function validerScore($score, $niveau, $nombreelemnt) {
    if ($niveau > 100) {
        return false;
    }

    if ($score - (100 * ($niveau - 1)) - ceil(2.5 * $nombreelemnt) === 0) {
        return true;
    }
    return false;
}

/*
 * Cette fonction verifie et insere un score dans la BDD
 */

function insererScore($idjoueur, $idjeu, $score, $niveau, $nombreelemnt) {
    if (validerScore($score, $niveau, $nombreelemnt)) {
        SQLExecuterRequete("INSERT INTO T_Score VALUES (NULL,:idpseudo,:idjeu,:score,NOW())", array("idpseudo" => $idjoueur, "idjeu" => $idjeu, "score" => $score));
        return true;
    }
    return false;
}

function validerScoreweak($score, $niveau) {
    if ($niveau > 100) {
        return false;
    } else
        return true;
}

/*
 * Cette fonction verifie et insere un score dans la BDD
 */

function insererScoreweak($idjoueur, $idjeu, $score, $niveau) {
    if (validerScoreweak($score, $niveau)) {
        SQLExecuterRequete("INSERT INTO T_Score VALUES (NULL,:idpseudo,:idjeu,:score,NOW())", array("idpseudo" => $idjoueur, "idjeu" => $idjeu, "score" => $score));
        return true;
    }
    return false;
}
