function Ennemi(posx, posy, taillex, tailley, dx, src) {
    Entity.call(this, posx, posy, taillex, tailley, dx, 0, src);
    this.name = "Ennemi";
}

Ennemi.prototype = Object.create(Entity.prototype);
Ennemi.prototype.constructor = Ennemi;

Ennemi.prototype.move = function (delta) {
    if (this.posx + (delta * this.dx) > 0 && this.posx + (delta * this.dx) < (canvasx - this.taillex)) {
        this.posx += (delta * this.dx);
        return false;
    }
    this.posx += (delta * this.dx);
    return true;

};

Ennemi.prototype.isDehors = function () {
    if (this.posy > canvasy) {
        return true;
    }
    return false;
};

Ennemi.prototype.tirer = function (array, posx, posy) {
    if (!(array instanceof Array)) {
        return false;
    }
    array.push(new Tir(posx, posy, null, this));
};