var touchesAppuyes = {};
// Met a jour les touches appuye
function settouche(event, etat) {
    var code = event.keyCode;
    var touche;
    switch (code) {
        case 32:
            touche = 'ESPACE';
            break;
        case 81:
            touche = 'Q';
            break;
        case 68:
            touche = 'D';
            break;
        case 90:
            touche = 'Z';
            break;
        default:
            touche = null;
    }
    touchesAppuyes[touche] = etat;
}
// Active les evenements
document.addEventListener('keydown', function (e) {
    settouche(e, true);
});

document.addEventListener('keyup', function (e) {
    settouche(e, false);
});
//Evite de conserver des saisies
window.addEventListener('blur', function () {
    touchesAppuyes = {};
});

function estAppuye(touche) {
    return touchesAppuyes[touche];
}

