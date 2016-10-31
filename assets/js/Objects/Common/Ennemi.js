function Ennemi(posx, posy, taillex, tailley) {
    SObject.call(this, posx, posy, taillex, tailley);
    this.direction = "right";
}

Ennemi.prototype = Object.create(SObject.prototype);
Ennemi.prototype.constructor = Ennemi;

Ennemi.prototype.move = function () {
    if (this.direction === "left") {
        if (this.posx - 5 > 0) {
            this.posx -= 5;
        } else if (this.posx - 5 <= 0)
        {
            this.direction = "right";
        }
    } else if (this.direction === "right") {
        if ((this.posx + 5) < (canvasx - this.taillex)) {
            this.posx += 5;
        } else if ((this.posx + 5) >= (canvasx - this.taillex)) {
            {
                this.direction = "left";
            }
        } else {
            console.warn("La direction est inconnu");
        }
    }
}
;