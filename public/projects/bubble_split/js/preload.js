var preload = function(game){}

preload.prototype ={

	preload:function(){
		var barra = this.add.sprite(this.game.width/2,this.game.height/2,"loading");
		barra.anchor.setTo(0.5,0.5);

		this.load.setPreloadSprite(barra);

		this.game.load.image("menuBack","projects/bubble_split/assets/menuBack.png");
		this.game.load.spritesheet("player", "projects/bubble_split/assets/dude.png", 181, 321);
		this.game.load.image("bola","projects/bubble_split/assets/bola.png");
		this.game.load.image("like","projects/bubble_split/assets/like.png");
		this.game.load.image("bullet","projects/bubble_split/assets/bullet.png");
		this.game.load.image("bullet2","projects/bubble_split/assets/bullet2.png");
		this.game.load.image("bullet3","projects/bubble_split/assets/bullet3.png");
		this.game.load.image("background","projects/bubble_split/assets/background.png");
		this.game.load.spritesheet('menuJogar', 'projects/bubble_split/assets/menuJogar.png', 265,83);
		this.game.load.spritesheet("menuInstrucao","projects/bubble_split/assets/menuInstrucao.png",265,83);
		this.game.load.spritesheet("playPause","projects/bubble_split/assets/playPause.png",40,41);
		this.game.load.spritesheet("audio","projects/bubble_split/assets/audio.png",40,41);
		this.game.load.image("changeBulletMenu","projects/bubble_split/assets/changeBulletMenu.png");
		this.game.load.image("bulletBack","projects/bubble_split/assets/bulletBack.png");
		this.game.load.image("nivel","projects/bubble_split/assets/nivel.png");
		this.game.load.image("jogoInfoBack","projects/bubble_split/assets/jogoInfoBack.png");
		this.game.load.image("VidaPontos","projects/bubble_split/assets/VidaPontos.png");
		this.game.load.image("Instrucoes","projects/bubble_split/assets/menuInstrucoes.png");
		this.game.load.image("exit","projects/bubble_split/assets/exit.png");
		this.game.load.image("torre","projects/bubble_split/assets/torre.png");

		this.load.audio('somFire', ['projects/bubble_split/assets/sounds/fire.wav']);
		this.load.audio('somHurt', ['projects/bubble_split/assets/sounds/hurt.wav']);
		this.load.audio('blop', ['projects/bubble_split/assets/sounds/blop.wav']);
		this.load.audio('backSound', ['projects/bubble_split/assets/sounds/backSound.wav']);

	},

	create : function(){
		this.game.state.start("titulojogo");
	}
}
