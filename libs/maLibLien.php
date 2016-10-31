<?php

function mkLien($url, $label, $newtab = false) {
    echo '<a href="' . urlencode($url) . '" ';
    if ($newtab) {
        echo 'target="_blank" ';
    }
    echo '>' . $label . '</a>';
}
