<?php

/*
 * Preparer a la creation d'un formulaire.
 */

function mkForm($method, $action) {
    echo '<form class = "form-horizontal" action="' . $action . '" method="' . $method . '">';
}

/*
 * Termine le formualaire.
 */

function endForm() {
    echo "</form>\n";
}

/*
 * Creer un element de type input pour un formulaire deja prepare au prealable
 */

function mkInput($type, $name, $label, $required = true, $defaultvalue = "") {

    echo '<div class = "form-group"><label for = "' . $name . '" class = "col-sm-2 control-label">' . $label . '</label><div class = "col-sm-10"><input type = "' . $type . '" class = "form-control" id = "' . $name . '" name="' . $name . '" placeholder = "' . $label . '" ';
    if (!empty($defaultvalue)) {
        echo 'value="' . $defaultvalue . '" ';
    }
    if ($required) {
        echo 'required="required" ';
    }
    echo '></div></div>';
}

/*
 * Creer un bouton d'envoi du formulaire
 */

function mkSubmit($defaultvalue) {
    echo '<input class="btn btn-primary" type="submit" name="action" value="' . $defaultvalue . '" >';
}

/*
 * Creer un bouton radio ou checkbox facilement
 */

function mkRadioCb($type, $name, $value, $label, $checked = false) {
    echo '<div class="' . $type . '"><label><input type="' . $type . '" name="' . $name . '" id="' . $name . '" value="' . $value . '" ';
    if ($checked) {
        echo 'checked="checked" ';
    }
    echo '>' . $label . '</label></div>';
}

/*
 * Creer un champ select.
 *
 * Le parametre $options doit etre de la forme pour chaque option a creer:
 * $options["NAME"] = LABEL;
 */

function mkSelect($name, $label, array $options, $default = null, $multiple = false) {
    echo '<div class="form-group"><label for="' . $name . '">' . $label . '</label><select name="' . $name . '" ';
    if ($multiple) {
        echo 'multiple="multiple"';
    }

    foreach ($options as $key => $value) {
        echo '<option name="' . $key . '" ';
        if (!empty($default) && $default === $key) {
            echo 'selected="selected" ';
        }
        echo '>' . $value . '</option>';
    }

    echo '></select></div>';
}
