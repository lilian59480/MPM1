function Tir(posx, posy, src, throwedby) {
    var dy;
    if (throwedby instanceof Player) {
        dy = -200;
    } else {
        dy = 200;
    }
    var taillex = 6;
    var tailley = 10;
    Entity.call(this, posx, posy, taillex, tailley, 0, dy, src);
    this.throwedby = throwedby;
}

Tir.prototype = Object.create(Entity.prototype);
Tir.prototype.constructor = Tir;
Tir.prototype.draw = function (ctx) {
    ctx.fillStyle = "#fff";
    ctx.fillRect(this.posx, this.posy, this.taillex, this.tailley);
};
Tir.prototype.move = function (delta) {
    if (this.posx + (delta * this.dx) > 0 && this.posx + (delta * this.dx) < (canvasx - this.taillex)) {
        this.posx += (delta * this.dx);
    }
    if (this.posy + (delta * this.dy) > -100 && this.posy + (delta * this.dy) < (canvasy - this.tailley) + 100) {
        this.posy += (delta * this.dy);
    }
};
Tir.prototype.isDehors = function () {
    if (this.posy < 0 && this.posy > canvasy) {
        return true;
    }
    return false;
};
Tir.prototype.isColision = function (obj) {
    if (!(obj instanceof Entity)) {
        return false;
    }
    if (this.throwedby.name === obj.name) {
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