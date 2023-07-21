var titulojogo = function(game){
	var button;
	var tween = null;
}

titulojogo.prototype = {

	create : function(){
		this.music = this.game.add.audio('backSound',0.2, true);
		this.music.play();
		//--Adicionar background e ajustar ao ecrã
		background=this.game.add.sprite(20, 20, "background");
		background.x = 0;
	    background.y = 0;
	    background.height = this.game.height;
	    background.width = this.game.width;
	    background.smoothed = false;

		//--Adicionar background Menu
		menuBack = this.game.add.sprite(0,0, "menuBack");
		menuBack.x = this.game.width/2;
	    menuBack.y = 270;
		menuBack.height = 260;
	    menuBack.width = 300;
		menuBack.anchor.setTo(0.5,0.5);

	 	var jogar = this.game.add.button(0,0, "menuJogar",this.iniciaJogo,this,1,0,1);
		jogar.input.useHandCursor = true;
		jogar.x = this.game.width/2;
	    jogar.y = 230;
		jogar.height = 83/1.5;
	    jogar.width = 265/1.5;
		jogar.anchor.setTo(0.5,0.5);


		var instrucoes = this.game.add.button(0,0, "menuInstrucao",this.menuInstrucao,this,1,0,1);
		instrucoes.input.useHandCursor = true;
		instrucoes.x = this.game.width/2;
	    instrucoes.y = 330;
		instrucoes.height = 83/1.5;
	    instrucoes.width = 265/1.5;
		instrucoes.anchor.setTo(0.5,0.5);

		var audio = this.game.add.button(0,0, "audio",this.audio,this);
		audio.on = false;
		audio.input.start();
		audio.input.useHandCursor = true;
		audio.x = this.game.width-50;
		audio.y = 50;
		audio.height = 40;
		audio.width = 41;
		audio.anchor.setTo(0.5,0.5);

		//--Menu Instruções
			this.popup = this.game.add.sprite(this.game.world.centerX, this.game.world.centerY, 'Instrucoes');
			this.popup.alpha = 0.8;
			this.popup.anchor.set(0.5);
			this.popup.inputEnabled = true;
			this.popup.input.enableDrag();

		//--Coordenadas para o botão de fechar o menuInstrucaoo
		    var pw = (this.popup.width / 2) - 40;
	   		var ph = (this.popup.height / 2) - 5;

       	//--Adicionar botao fechas menuInstrucao
		    var closeButton = this.game.make.sprite(pw, -ph, 'exit');
	   		closeButton.inputEnabled = true;
		   	closeButton.input.priorityID = 1;
		   	closeButton.input.useHandCursor = true;
		   	closeButton.events.onInputDown.add(this.fecharMenuInstrucao, this);

       	//--Adicionar o botão ao popup
       		this.popup.addChild(closeButton);
       	//--Esconder o botão
       		this.popup.scale.set(0);
	},
	iniciaJogo : function(){
		this.music.stop();
		this.game.state.start("oJogo");
	},
	audio : function(audio){
        audio.on = !audio.on;
        audio.setFrames((audio.on)?1:0, (audio.on)?1:0, 0);
        audio.frame = (audio.on)?1:0;
		if(!audio.on)
		{
			this.music.resume();
		}
		else {
			this.music.pause();
		}
    },
	menuInstrucao : function(tween){
		if ((tween !== null && tween.isRunning) || this.popup.scale.x === 1)
	    {
	        return;
	    }

	    //  Create a tween that will pop-open the window, but only if it's not already tweening or open
	    tween = this.game.add.tween(this.popup.scale).to( { x: 1, y: 1 }, 1000, Phaser.Easing.Elastic.Out, true);
	},
	fecharMenuInstrucao : function(tween){
		if (tween && tween.isRunning ||this.popup.scale.x === 0.1)
	    {
	        return;
	    }
	    //  Create a tween that will close the window, but only if it's not already tweening or closed
	    tween = this.game.add.tween(this.popup.scale).to( { x: 0, y: 0 }, 500, Phaser.Easing.Elastic.In, true);

	}
}
