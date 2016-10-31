<?php

define("STRING", -1);
define("INTEGER", 0);
define("BOOLEAN", 1);
define("MAIL", 2);
define("FLOAT", 3);
define("IP", 4);
define("URL", 5);

include_once 'maLibSQL.pdo.php';
include_once 'maLibForms.php';
include_once 'maLibTable.php';
include_once 'maLibLien.php';
include_once 'maLibUtils.php';
include_once 'maLibSecurisation.php';

include_once "modele/modele.php";
