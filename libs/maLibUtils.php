<?php

/*
 * Cette fonction est similaire a la fonction en dessous.
 * En plus de verifier si la variable est definie, elle verifie si elle est du type voulu et nettoye une petite partie des caracteres indesirables.
 * Attention, elle retourne NULL si la validation a echoue, car elle verifie les booleans aussi, et retourner false est quelque chose d'imprudent.
  function valider($nom, $type = "REQUEST") {
  switch ($type) {
  case 'REQUEST':
  if (isset($_REQUEST[$nom]) && !($_REQUEST[$nom] == ""))
  return proteger($_REQUEST[$nom]);
  break;
  case 'GET':
  if (isset($_GET[$nom]) && !($_GET[$nom] == ""))
  return proteger($_GET[$nom]);
  break;
  case 'POST':
  if (isset($_POST[$nom]) && !($_POST[$nom] == ""))
  return proteger($_POST[$nom]);
  break;
  case 'COOKIE':
  if (isset($_COOKIE[$nom]) && !($_COOKIE[$nom] == ""))
  return proteger($_COOKIE[$nom]);
  break;
  case 'SESSION':
  if (isset($_SESSION[$nom]) && !($_SESSION[$nom] == ""))
  return $_SESSION[$nom];
  break;
  case 'SERVER':
  if (isset($_SERVER[$nom]) && !($_SERVER[$nom] == ""))
  return $_SERVER[$nom];
  break;
  }
  return false;
  }
 */

function valider($variable_name, $type, $typevariable = -1) {
    switch ($typevariable) {
        case INTEGER:
            $filtersan = FILTER_SANITIZE_NUMBER_INT;
            $filterval = FILTER_VALIDATE_INT;
            break;
        case BOOLEAN:
            $filtersan = FILTER_SANITIZE_STRING;
            $filterval = FILTER_VALIDATE_BOOLEAN;
            break;
        case MAIL:
            $filtersan = FILTER_SANITIZE_EMAIL;
            $filterval = FILTER_VALIDATE_EMAIL;
            break;
        case FLOAT:
            $filtersan = FILTER_SANITIZE_NUMBER_FLOAT;
            $filterval = FILTER_VALIDATE_FLOAT;
            break;
        case IP:
            $filtersan = FILTER_SANITIZE_FULL_SPECIAL_CHARS;
            $filterval = FILTER_VALIDATE_IP;
            break;
        case URL:
            $filtersan = FILTER_SANITIZE_URL;
            $filterval = FILTER_VALIDATE_URL;
            break;
        default:
            $filtersan = FILTER_UNSAFE_RAW;
            $filterval = FILTER_DEFAULT;
            break;
    }
    if ($type == INPUT_SESSION) {
        $sanitized = filter_var($_SESSION[$variable_name], $filtersan);
    } else {
        $sanitized = filter_input($type, $variable_name, $filtersan);
    }
    if (filter_var($sanitized, $filterval)) {
        return $sanitized;
    } else {
        return null;
    }
}

/*
 * Cette fonction permet de voir le contenu d'une variable bien plus facilement
 */

function __debug($var) {
    echo "<pre>\n";
    if (is_string($var)) {
        $var = protegerAffichage($var);
    }
    var_dump($var);
    echo "</pre>\n";
}

/*
 * Cette fonction permet de rediriger vers une autre page.
 */

function rediriger($url) {
    header('Location:' . urlencode($url));
    die("");
}
