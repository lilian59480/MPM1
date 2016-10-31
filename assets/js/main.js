var gameover = false;
var score = 0;
var niveau = 1;

function jouer() {
    document.getElementById('menu').style.display = 'none';
    document.getElementById('gm').style.display = 'none';
    document.getElementById('jeu').style.display = 'block';
    document.getElementById('score').style.display = 'block';
    play();
}