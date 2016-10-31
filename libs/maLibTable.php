<?php

/*
 * Creer un tableau a partir d'un array
 */

function mkTable($titre, array $tab, array $label, array $listeaafficher) {
    echo '<div class="table-responsive"><table class="table table-hover"><caption>' . $titre . '</caption>';
    if (count($tab) > 0) {
        mkLigneEntete($label);
        echo '<tbody>';
        foreach ($tab as $value) {
            mkLigne($value, $listeaafficher);
        }
        echo'</tbody>';
    }
    echo '</table></div>';
}

function mkLigneEntete(array $tab) {
    echo '<thead><tr>';
    foreach ($tab as $value) {
        echo '<th>' . $value . '</th>';
    }
    echo '</tr></thead>';
}

function mkLigne($tab, array $listeaafficher) {
    echo '<tr>';
    foreach ($listeaafficher as $value) {
        echo '<td>' . $tab[$value] . '</td>';
    }
    echo '</tr>';
}
