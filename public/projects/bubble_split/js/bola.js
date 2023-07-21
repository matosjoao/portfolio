Bola = function(game, x, y,tipo) {

    //--Atribuir Imagem á bola
    Phaser.Sprite.call(this, game, x, y, 'bola');

    game.physics.enable(this, Phaser.Physics.ARCADE);
    this.body.velocity.x = 200;
    this.body.velocity.y = 200;
    this.body.maxVelocity.x=200;
    this.body.maxVelocity .y=200;
    this.body.collideWorldBounds = true;
    this.body.bounce.setTo(1,1);
    this.tipo=tipo;

    if(this.tipo==1)
    {
        this.scale.setTo(1);
    }
    else if(this.tipo==2)
    {
        this.scale.setTo(0.5);
    }
    else if(this.tipo==3)
    {
        this.scale.setTo(0.25);
    }


};

Bola.prototype = Object.create(Phaser.Sprite.prototype);
Bola.prototype.constructor = Bola;
