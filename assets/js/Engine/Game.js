function play() {
    var offCanvas = document.createElement("canvas");
    offCanvas.width = canvasx;
    offCanvas.height = canvasy;
    var offCtx = offCanvas.getContext("2d");

    var canvas = document.getElementById("jeu");
    canvas.width = canvasx;
    canvas.height = canvasy;
    var ctx = canvas.getContext("2d");
    var joueur;
    var ennemi;
    var datenow = Date.now();
    var derniertir = Date.now();
    var tirs = new Array();
    var lastdx = 300;
    reset(lastdx);
    main();

    function reset(dx) {
        joueur = new Player(canvasx / 2 - 32, canvasy - 75, 65, 68, img["joueur"]);
        ennemi = new Array();
        tirs.splice(0, tirs.length);
        for (var i = 0; i < 5; i++) {
            for (var j = 0; j < 10; j++) {
                ennemi.push(new Ennemi(1 + 50 * j, 1 + 50 * i, 41, 40, dx, img["ennemi"]));
            }
        }
    }
    function main() {
        var now = Date.now();
        var temps = (now - datenow) / 1000.0;
        if (gameover) {
            document.getElementById('menu').style.display = 'none';
            document.getElementById('gm').style.display = 'block';
            document.getElementById('jeu').style.display = 'none';
            document.getElementById('score').style.display = 'none';
            return true;
        } else {
            miseajour(temps);
            rendu();
            if (collisions()) {
                gameover = true;
            }
            if (verifnouveauniveau()) {
                modifierscore(100);
                modifierniveau();
                lastdx += 50;
                reset(lastdx);
            }
            datenow = now;
            window.requestAnimationFrame(main);
        }
    }

    function rendu() {
        offCtx.clearRect(0, 0, canvasx, canvasy);
        joueur.draw(offCtx);
        for (var i = 0; i < ennemi.length; i++) {
            ennemi[i].draw(offCtx);
        }
        for (var i = 0; i < tirs.length; i++) {
            tirs[i].draw(offCtx);
        }
        ctx.clearRect(0, 0, canvasx, canvasy);
        ctx.drawImage(offCanvas, 0, 0);
    }

    function miseajour(temps) {
        for (var i = 0; i < ennemi.length; i++) {
            var lvl = (Math.floor(Math.random() * 1001));
            if (lvl < niveau) {
                ennemi[i].tirer(tirs, ennemi[i].posx + (ennemi[i].taillex / 2) - 5, ennemi[i].posy + 10);
            }
        }
        if (estAppuye('Q')) {
            joueur.setDx(-150);
        }

        if (estAppuye('D')) {
            joueur.setDx(150);
        }

        if (!estAppuye('D') && !estAppuye('Q')) {
            joueur.setDx(0);
        }

        if (estAppuye('Z')) {
            if (derniertir + 300 < datenow) {
                derniertir = datenow;
                joueur.tirer(tirs, joueur.posx + (joueur.taillex / 2) - 5, joueur.posy - 10);
            }
        }

        for (var i = 0; i < tirs.length; i++) {
            tirs[i].move(temps);
            if (tirs[i].isDehors()) {
                tirs.splice(i, 1);
            }
        }
        joueur.move(temps);
        var needreturn = false;
        for (var i = 0; i < ennemi.length; i++) {
            if (ennemi[i].move(temps)) {
                needreturn = true;
            }
        }
        if (needreturn) {
            for (var i = 0; i < ennemi.length; i++) {
                ennemi[i].setDx(-ennemi[i].dx);
                ennemi[i].move(temps);
                ennemi[i].posy += 20;
            }
        }
    }

    function collisions() {
        for (var i = 0; i < ennemi.length; i++) {
            if (joueur.isColision(ennemi[i]) || ennemi[i].isDehors())
            {
                return true;
            }
            for (var j = 0; j < tirs.length; j++) {
                if (tirs[j].isColision(ennemi[i])) {
                    tirs.splice(j, 1);
                    ennemi.splice(i, 1);
                    modifierscore(2.5);
                }
                if (tirs[j].isColision(joueur)) {
                    gameover = true;
                }
            }
        }
    }

    function modifierscore(points) {
        score += points;
        document.getElementById("actuscore").innerHTML = Math.ceil(score);
        document.getElementById("inputScore").value = Math.ceil(score);
    }
    function modifierniveau() {
        niveau++;
        document.getElementById("actuniveau").innerHTML = niveau;
        document.getElementById("inputNiveau").value = niveau;
    }

    function verifnouveauniveau() {
        if (ennemi.length === 0) {
            return true;
        }
        return false;
    }
}
;

