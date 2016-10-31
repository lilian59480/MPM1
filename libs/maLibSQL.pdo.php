<?php

/*
 * Prepare une requete SQL.
 * Il est preferable d'utiliser SQLExecuterRequete() sauf si on veut controller l'execution d'une requete.
 */

function SQLPreparerRequete($sql) {
    $BDD_host = "localhost";
    $BDD_user = "root";
    $BDD_password = "";
    $BDD_base = "arcade";

    try {
        $dbh = new PDO('mysql:host=' . $BDD_host . ';dbname=' . $BDD_base . ';charset=utf8', $BDD_user, $BDD_password);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->exec("SET CHARACTER SET utf8");
        $return = $dbh->prepare($sql);
    } catch (Exception $e) {
        ob_end_clean();
        die('<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width, initial-scale=1"><title>Arcade 2i</title><link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/><link rel="stylesheet" type="text/css" href="assets/css/style.css"/><script src="https://code.jquery.com/jquery-2.2.3.min.js"></script><script src="assets/js/bootstrap.js"></script></head><body><div class="container"><div class="row"><div class="alert alert-danger">Erreur lors de l\'execution de la page : ' . $e->getMessage() . '</div></div></div></body></html>');
    }
    return $return;
}

/*
 * Prepare et execute une requete SQL avec les parametres envoyees dans le tableau $arg.
 * Les parametres s'utilise de la maniere suivante :
 *
 * REQUETE : SELECT * FROM T_Utilisateur WHERE id = :id ;
 *
 * Le parametre est :id ici et donc le parametre doit etre de la forme suivante:
 *
 * $arg["id"] = 12;
 *
 */

function SQLExecuterRequete($sql, array $arg) {
    try {
        $sth = SQLPreparerRequete($sql);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($arg as $key => &$val) {
            $sth->bindParam($key, $val);
        }
        if (!$sth->execute()) {
            throw new Exception("La requete SQL a echouee", 500);
        }
    } catch (Exception $e) {
        ob_end_clean();
        die('<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width, initial-scale=1"><title>Arcade 2i</title><link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/><link rel="stylesheet" type="text/css" href="assets/css/style.css"/><script src="https://code.jquery.com/jquery-2.2.3.min.js"></script><script src="assets/js/bootstrap.js"></script></head><body><div class="container"><div class="row"><div class="alert alert-danger">Erreur lors de l\'execution de la page : ' . $e->getMessage() . '</div></div></div></body></html>');
    }
    return $sth;
}

/*
 * Renvoit les donnees d'une requete deja execute.
 */

function SQLDonnees($sth) {
    try {
        return $sth->fetchAll();
    } catch (Exception $e) {
        ob_end_clean();
        die('<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width, initial-scale=1"><title>Arcade 2i</title><link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/><link rel="stylesheet" type="text/css" href="assets/css/style.css"/><script src="https://code.jquery.com/jquery-2.2.3.min.js"></script><script src="assets/js/bootstrap.js"></script></head><body><div class="container"><div class="row"><div class="alert alert-danger">Erreur lors de l\'execution de la page : ' . $e->getMessage() . '</div></div></div></body></html>');
    }
}
