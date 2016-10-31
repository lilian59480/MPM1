<?php

ob_start();
session_start();

include_once "libs/Libs.php";

$view = valider("view", INPUT_GET);
if (!$view)
    $view = "accueil";


include("templates/header.php");

switch ($view) {

    case "accueil" :
        include("templates/accueil.php");
        break;


    default :
        if (file_exists("templates/$view.php"))
            include("templates/$view.php");
}

include("templates/footer.php");
ob_end_flush();
