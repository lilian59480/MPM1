function Player(posx, posy, taillex, tailley, src) {
    Entity.call(this, posx, posy, taillex, tailley, 0, 0, src);
    this.name = "Joueur";
}

Player.prototype = Object.create(Entity.prototype);
Player.prototype.constructor = Player;

Player.prototype.tirer = function (array, posx, posy) {
    if (!(array instanceof Array)) {
        return false;
    }
    array.push(new Tir(posx, posy, null, this));
};