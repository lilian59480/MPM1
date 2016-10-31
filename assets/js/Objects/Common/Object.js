var Entity = function (posx, posy, taillex, tailley, dx, dy, src) {
    this.posx = posx;
    this.posy = posy;
    this.taillex = taillex;
    this.tailley = tailley;
    this.dx = dx;
    this.dy = dy;
    this.sprite = src;
};

Entity.prototype._debug = function () {
    console.log(this);
};

Entity.prototype.draw = function (ctx) {
    ctx.drawImage(this.sprite, this.posx, this.posy);
};

Entity.prototype.move = function (delta) {
    if (this.posx + (delta * this.dx) > 0 && this.posx + (delta * this.dx) < (canvasx - this.taillex)) {
        this.posx += (delta * this.dx);
    }
    if (this.posy + (delta * this.dy) > 0 && this.posy + (delta * this.dy) < (canvasy - this.tailley)) {
        this.posy += (delta * this.dy);
    }
};

Entity.prototype.setDx = function (dx) {
    this.dx = dx;
};

Entity.prototype.setDy = function (dy) {
    this.dy = dy;
};

Entity.prototype.isColision = function (obj) {
    if (!(obj instanceof Entity)) {
        return false;
    }

    if (this.posx < obj.posx + obj.taillex) {
        if (this.posx + this.taillex > obj.posx) {
            if (this.posy < obj.posy + obj.tailley) {
                if (this.posy + this.tailley > obj.posy) {
                    return true;
                }
            }
        }
    }

};