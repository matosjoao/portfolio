var oJogo = function(game) {
    var cursors;
    var lifes;
    var stateText;
    var bullets;
    var fireButton;
    var bullt;
}
oJogo.prototype = {

    create: function() {

    //--Adicionar Physics
    this.game.physics.startSystem(Phaser.Physics.ARCADE);

        //--Adicionar Physics para o Jogador
        this.player = this.game.add.sprite(this.game.world.centerX, 360, 'player');
        this.player.height = 321/4;
	    this.player.width = 181/4;
        this.player.animations.add('left', [0, 1, 2, 3], 5, true);
        this.player.animations.add('right', [5, 6, 7, 8], 5, true);
        this.game.physics.arcade.enable(this.player);
        this.player.body.collideWorldBounds = true;

        //--Adicionar o control com o teclado
        cursors = this.game.input.keyboard.createCursorKeys();
        this.game.camera.follow(this.player);

        //--Adicionar physics PLayer
        this.game.physics.enable(this.player, Phaser.Physics.ARCADE);

        //--Adicionar as Bola
        bolas = this.game.add.group();
        bolas.enableBody = true;
        bolas.physicsBodyType = Phaser.Physics.ARCADE;
        //--Criar N bolas e adiciona-las ao group
        for (var x = 0; x < 1; x++)
        {
            var b = new Bola(this.game, 30 + (x*100), 30 + (x*52),1);
            //--Adicionar no Jogo
            this.game.add.existing(b);
            //--Adicionar no grupo
            bolas.add(b);
        }

        //--Quando a Bola tocar no player o player não se mexer
        this.player.body.immovable = true;

        //--Balas
        this.DisparaBala = true;
        bullets = this.game.add.group();
        bullets.enableBody = true;
        bullets.physicsBodyType = Phaser.Physics.ARCADE;
        for (var i = 0; i < 20; i++) {
            bullt = bullets.create(0, 0, 'bullet');
            bullt.name = 'bullet' + i;
            bullt.exists = false;
            bullt.visible = false;
            bullt.checkWorldBounds = true;
            bullt.events.onOutOfBounds.add(this.resetBullet, this);
        }
        //--Adicionar space control para dispara a Bala
        fireButton = this.game.input.keyboard.addKey(Phaser.Keyboard.SPACEBAR);

    //--Adicionar GUI vidas,tempo...
            this.game.stage.backgroundColor = "#b0d6f2";

        //--BackGround GUI
            this.jogoInfoBack = this.game.add.sprite(0,0, "jogoInfoBack");
            this.jogoInfoBack.x = 0;
            this.jogoInfoBack.y = 438;
            this.jogoInfoBack.height = 110;
            this.jogoInfoBack.width = this.game.width;
            this.game.physics.enable(this.jogoInfoBack, Phaser.Physics.ARCADE);
            this.jogoInfoBack.enableBody = true;
            this.jogoInfoBack.body.immovable = true;
        //--Titulo Nivel
            this.tituloNivel = this.game.add.sprite(0,0, "nivel");
            this.tituloNivel.x = this.jogoInfoBack.width/2-50;
            this.tituloNivel.y = 460;
            this.tituloNivel.height = 40;
            this.tituloNivel.width = 140;

            this.textEscolha = this.game.add.text(this.jogoInfoBack.width/2, 505, "1", {
                font: "15px Jelly Crazies",
                fill: "#ecb837",
                stroke:'#fff',
                strokeThickness : 6});

        //--Botao Menu Bala
            this.BulletBotao = this.game.add.button(0,0, "changeBulletMenu",this.menuInstrucao,this);
            this.BulletBotao.on = false;
            this.BulletBotao.input.start();
            this.BulletBotao.input.useHandCursor = true;
            this.BulletBotao.x = this.game.width-50;
            this.BulletBotao.y = 485;
            this.BulletBotao.height = 40;
            this.BulletBotao.width = 41;
            this.BulletBotao.anchor.setTo(0.5,0.5);
            //--Menu Bala Background
    			this.popup = this.game.add.sprite(0, 0, 'bulletBack');
    			this.popup.alpha = 0.8;
    			this.popup.anchor.set(0.5);
                this.popup.x = this.game.width-80;
                this.popup.y = 370;
                this.popup.inputEnabled = true;
                this.popup.input.enableDrag();
            //--Coordenadas para o botão de fechar o menuInstrucaoo
        		var pw = (this.popup.width / 2) - 60;
        	   	var ph = (this.popup.height / 2) - 15;

            //--Adicionar botao fechas menuInstrucao
        		var closeButtonPopup = this.game.make.sprite(pw, -ph, 'exit');
                closeButtonPopup.height = 50;
                closeButtonPopup.width = 50;
        	   	closeButtonPopup.inputEnabled = true;
                closeButtonPopup.input.priorityID = 1;
                closeButtonPopup.input.useHandCursor = true;
        	    closeButtonPopup.events.onInputDown.add(this.fecharMenuInstrucao, this);

                this.textEscolha = this.game.add.text(-100, -90, "MUDAR BALA", {
                    font: "12px Jelly Crazies",
                    fill: "#000",});
            //--Adicionar escolha de balas
                this.bulletChoose = this.game.add.button(0,0, "bullet");
                this.bulletChoose.events.onInputDown.add(this.changeBullet, this);
                closeButtonPopup.input.priorityID = 2;
                this.bulletChoose.input.useHandCursor = true;
                this.bulletChoose.x = -90;
                this.bulletChoose.y = -30;
                this.bulletChoose.height = 31;
                this.bulletChoose.width = 19;
                this.bulletChoose.anchor.setTo(0.5,0.5);

                this.text1 = this.game.add.text(-50, -40, "Bala 1", {
                    font: "20px Arial",
                    fill: "#00",});

                this.bulletChoose2 = this.game.add.button(0,0, "bullet2");
                this.bulletChoose2.events.onInputDown.add(this.changeBullet2, this);
                this.bulletChoose2.input.priorityID = 3;
                this.bulletChoose2.input.useHandCursor = true;
                this.bulletChoose2.x = -90;
                this.bulletChoose2.y = 10;
                this.bulletChoose2.height = 31;
                this.bulletChoose2.width = 19;
                this.bulletChoose2.anchor.setTo(0.5,0.5);

                this.text2 = this.game.add.text(-50, 0, "Bala 2", {
                    font: "20px Arial",
                    fill: "#00",});

                this.bulletChoose3 = this.game.add.button(0,0, "bullet3");
                this.bulletChoose3.events.onInputDown.add(this.changeBullet3, this);
                this.bulletChoose3.input.priorityID = 4;
                this.bulletChoose3.input.useHandCursor = true;
                this.bulletChoose3.x = -90;
                this.bulletChoose3.y = 50;
                this.bulletChoose3.height = 31;
                this.bulletChoose3.width = 19;
                this.bulletChoose3.anchor.setTo(0.5,0.5);

                this.text3 = this.game.add.text(-50, 40, "Bala 3", {
                    font: "20px Arial",
                    fill: "#00",});

            //--Adicionar o botão ao popup
                this.popup.addChild(closeButtonPopup);
                this.popup.addChild(this.bulletChoose);
                this.popup.addChild(this.bulletChoose2);
                this.popup.addChild(this.bulletChoose3);
                this.popup.addChild(this.text1);
                this.popup.addChild(this.text2);
                this.popup.addChild(this.text3);
                this.popup.addChild(this.textEscolha);
            //--Esconder o botão
                this.popup.scale.set(0);

        //--Botao Pausa
            this.pausaBotao = this.game.add.button(0,0, "playPause",this.togglePause,this);this.pausaBotao.on = false;
            this.pausaBotao.input.start();
            this.pausaBotao.input.useHandCursor = true;
            this.pausaBotao.x = this.game.width-100;
            this.pausaBotao.y = 485;
            this.pausaBotao.height = 40;
            this.pausaBotao.width = 41;
            this.pausaBotao.anchor.setTo(0.5,0.5);
        //--Botao Audio
            this.audioOnOff = true;
            //--Audio Fire
            this.somFire = this.game.add.audio('somFire');
            //--Audio Hurt
            this.somHurt = this.game.add.audio('somHurt');
            //--Audio Blop
            this.blop = this.game.add.audio('blop');

            this.audio = this.game.add.button(0,0, "audio",this.toggleaudio,this);this.audio.on = false;
            this.audio.input.start();
            this.audio.input.useHandCursor = true;
            this.audio.x = this.game.width-150;
            this.audio.y = 485;
            this.audio.height = 40;
            this.audio.width = 41;
            this.audio.anchor.setTo(0.5,0.5);


        //--Adicionar tempo
            //--Width Bar
            this.barProgress = 780;
            //--Criar a Barra
            this.bar = this.add.bitmapData(780,50);
            this.barTime =this.game.add.sprite(0, 0, this.bar);
            //--Criar Tween para dizer que a barra vai diminuindo
            this.tweenBar = this.game.add.tween(this).to({barProgress: 0}, 20000, null, true, 0 ,Infinity);

        //--Adicionar  Vidas e Pontos
        this.VidaPontos = this.game.add.sprite(0,0, "VidaPontos");
        this.VidaPontos.x = 50;
        this.VidaPontos.y = 465;
        this.VidaPontos.height = 93/1.25;
        this.VidaPontos.width = 198/1.25;

            lives = this.game.add.group();
            for (var i = 0; i < 3; i++) {
                var live = lives.create(140 + (20 * i), 473, 'like');
                live.scale.setTo(0.5);

            }

            this.scoreString = '   ';
            this.score = 0;
            this.scoreText = this.game.add.text(140, 516, this.scoreString + this.score, {
                font: "12px Arial",
                fill: "#fff",
                align: "center" });



        //--GameOver
        stateText = this.game.add.text(this.game.world.centerX, this.game.world.centerY-50, ' ', {
            font: '20px Arial',
            fill: '#000'
        });
        stateText.anchor.setTo(0.5, 0.5);
        stateText.visible = false;

        //--Pausar Jogo
        this.pause = this.input.keyboard.addKey(Phaser.Keyboard.P);
        this.pause.onDown.add(this.togglePause, this);
        this.pause.enabled = true;

    },
    update: function() {
        //--Verificar colisões
        this.game.physics.arcade.collide(bolas, this.jogoInfoBack);
        //--Colisão para o player e a bola
        this.game.physics.arcade.collide(this.player, bolas, this.mostraVida, null, this);
        //--Ver qual a tecla pressionada e mudar a direção do player
        this.player.body.velocity.x = 0;

        if (cursors.left.isDown) {
            this.player.body.velocity.x = -300;
            this.player.animations.play('left');
        } else if (cursors.right.isDown) {
            this.player.body.velocity.x = 300;
            this.player.animations.play('right');
        } else {
            this.player.animations.stop();
            this.player.frame = 4;
        }
        //--Disparar?
        if (fireButton.isDown) {

            this.fireBullet();
        }
        //--Colisão para o bola e a bolas
        this.game.physics.arcade.overlap(bullets, bolas, this.collisionHandler, null, this);

        //--Tempo
            //--Ir limpando a Bar
            this.bar.context.clearRect(0, 0, this.bar.width, this.bar.height);
            //--Mudar Cor quando chegar a uma certa width
            if(this.barProgress <1)
            {
                this.player.kill();
                bolas.removeAll();
                this.DisparaBala = false;
                this.barTime.kill();
                this.pause.enabled = false;
                //Colocar Texto GameOver
                stateText.text = " Perdeu! \n Clique para reiniciar";
                stateText.visible = true;
                //Clicar para reiniciar
                this.game.input.onTap.addOnce(this.restart, this);
            }
                else if (this.barProgress < 170) {
                    this.bar.context.fillStyle = '#f00';
                }
                else if (this.barProgress < 360) {
                    this.bar.context.fillStyle = '#916a37';
                }
                else {
                    this.bar.context.fillStyle = '#916a37';
                }
           //--Desenhar a Barra
           this.bar.context.fillRect(0, 0, this.barProgress, 8);
           //-- important - without this line, the context will never be updated on the GPU when using webGL
           this.bar.dirty = true;
    },
    restart : function() {
        this.game.state.start("titulojogo");
    },
    changeBullet :function(){
        //--verificar se o disparar esta a true para podermos mudar a Bala
            if(this.DisparaBala==true)
            {
                bullets.removeAll();
                for (var i = 0; i < 20; i++) {
                    bullt = bullets.create(0, 0, 'bullet');
                    bullt.name = 'bullet' + i;
                    bullt.exists = false;
                    bullt.visible = false;
                    bullt.checkWorldBounds = true;
                    bullt.events.onOutOfBounds.add(this.resetBullet, this);
                    //bullt.loadTexture('bullet2', 0);
                }
            }
            else
            {
                console.log("Não pode Mudar a bala");
            }
    },
    changeBullet2 :function(){
        //--verificar se o disparar esta a true para podermos mudar a Bala
            if(this.DisparaBala==true)
            {
                bullets.removeAll();
                for (var i = 0; i < 20; i++) {
                    bullt = bullets.create(0, 0, 'bullet2');
                    bullt.name = 'bullet2' + i;
                    bullt.exists = false;
                    bullt.visible = false;
                    bullt.checkWorldBounds = true;
                    bullt.events.onOutOfBounds.add(this.resetBullet, this);
                    //bullt.loadTexture('bullet2', 0);
                }
            }
            else
            {
                console.log("Não pode Mudar a bala");
            }
    },
    changeBullet3 :function(){
        //--verificar se o disparar esta a true para podermos mudar a Bala
            if(this.DisparaBala==true)
            {
                bullets.removeAll();
                for (var i = 0; i < 20; i++) {
                    bullt = bullets.create(0, 0, 'bullet3');
                    bullt.name = 'bullet3' + i;
                    bullt.exists = false;
                    bullt.visible = false;
                    bullt.checkWorldBounds = true;
                    bullt.events.onOutOfBounds.add(this.resetBullet, this);
                    //bullt.loadTexture('bullet2', 0);
                }
            }
            else
            {
                console.log("Não pode Mudar a bala");
            }
    },
	menuInstrucao : function(tween){
		if ((tween !== null && tween.isRunning) || this.popup.scale.x === 0.55)
	    {
	        return;
	    }

	    //  Create a tween that will pop-open the window, but only if it's not already tweening or open
	    tween = this.game.add.tween(this.popup.scale).to( { x: 0.55, y: 0.50 }, 1000, Phaser.Easing.Elastic.Out, true);
	},
	fecharMenuInstrucao : function(tween){
		if (tween && tween.isRunning ||this.popup.scale.x === 0.1)
	    {
	        return;
	    }
	    //  Create a tween that will close the window, but only if it's not already tweening or closed
	    tween = this.game.add.tween(this.popup.scale).to( { x: 0, y: 0 }, 500, Phaser.Easing.Elastic.In, true);

	},
    audioFire : function(){
        if ( this.audioOnOff ) {
			this.somFire.play();
		}
    },
    audioHurt : function(){
        if ( this.audioOnOff ) {
			this.somHurt.play();
		}
    },
    audioBlop : function(){
        if ( this.audioOnOff ) {
			this.blop.play();
		}
    },
    mostraVida: function() {
        //Eliminar Bala
        this.audioHurt();
        //Vai buscar o 1º elemento existente do groupo Lives
        live = lives.getFirstAlive();
        //Remove esse elemento
        if (live) {
            live.kill();
        }
        //Ver quantas vidas ainda tem no grupo
        if (lives.countLiving() < 1) {
            //Eliminar Assets
            this.player.kill();
            bolas.removeAll();
            this.DisparaBala = false;
            this.pause.enabled = false;
            this.bar.destroy();
            this.game.tweens.removeAll();
            //Colocar Texto GameOver
            stateText.text = " Perdeu! \n Clique para reiniciar";
            stateText.visible = true;
            //Clicar para reiniciar
            this.game.input.onTap.addOnce(this.restart,this);
        }
    },
    collisionHandler: function(bullet, bola) {
        //--Quando a bala atinge a bola
        //--Eliminar bola
        bullets.remove(bullet);
        bullet.kill();

        //--Aumentar Score
        this.score += 20;
        this.scoreText.text = this.scoreString + this.score;

        if(bola.tipo==1)
        {
            this.audioBlop();
            bola.kill();

                var b = new Bola(this.game, bola.x + 50, bola.y + 50,2);
                b.body.velocity.y = -200;

                var b1 = new Bola(this.game, bola.x - 50, bola.y - 50,2);
                b1.body.velocity.y = -200;
                b1.body.velocity.x = -200;

                //--Adicionar no Jogo
                this.game.add.existing(b);
                this.game.add.existing(b1);
                //--Adicionar no grupo
                bolas.add(b);
                bolas.add(b1);
        }
        else if(bola.tipo==2)
        {
            bola.kill();
            this.audioBlop();

            var b2 = new Bola(this.game, bola.x + 30, bola.y + 30,3);
            b2.body.velocity.y = -200;

            var b3 = new Bola(this.game, bola.x - 30, bola.y - 30,3);
            b3.body.velocity.y = -200;
            b3.body.velocity.x = -200;

            //--Adicionar no Jogo
            this.game.add.existing(b2);
            this.game.add.existing(b3);
            //--Adicionar no grupo
            bolas.add(b2);
            bolas.add(b3);
        }
        else if(bola.tipo==3)
        {
            bola.kill();
            this.audioBlop();
        }

        this.DisparaBala = true;
        //--Ver se não há mais bolas no Stage
        if(bolas.countLiving() == 0){
            this.player.kill();
            this.bar.destroy();
            this.game.tweens.removeAll();
            this.DisparaBala = false;
            this.pause.enabled = false;
            stateText.text = "Ganhou, \nClique para reiniciar";
            stateText.visible = true;
            this.game.input.onTap.addOnce(this.restart, this);
        }
    },
    fireBullet: function(DisparaBala) {
        if (this.DisparaBala) {
            this.audioFire();
            //--Por o DisparaBala=False para nao poder dispara enquanto a bala nao desaparecer
            this.DisparaBala = false;
            //--Ir buscar a primeira bala do grupo
            var bullet2 = bullets.getFirstExists(false);
            if (bullet2) {
                bullet2.reset(this.player.x, this.player.y + 8);
                bullet2.body.velocity.y = -400;
            }
        }
    },
    resetBullet: function(bullet, DisparaBala) {
        this.DisparaBala = true;
        bullet.kill();
    },
    togglePause: function() {
        this.game.physics.arcade.isPaused = (this.game.physics.arcade.isPaused) ? false : true;

        if (this.game.physics.arcade.isPaused) {
            stateText.text = "Jogo em Pausa";
            stateText.visible = true;
            this.tweenBar.pause();
        } else {
            stateText.visible = false;
            this.tweenBar.resume();
        }
        this.pausaBotao.on = !this.pausaBotao.on;
        this.pausaBotao.setFrames((this.pausaBotao.on)?1:0, (this.pausaBotao.on)?1:0, 0);
        this.pausaBotao.frame = (this.pausaBotao.on)?1:0;
    },
    toggleaudio : function(){
        this.audio.on = !this.audio.on;
        this.audio.setFrames((this.audio.on)?1:0, (this.audio.on)?1:0, 0);
        this.audio.frame = (this.audio.on)?1:0;
        if(!this.audio.on)
        {
            this.audioOnOff = true;
        }
        else {
            this.audioOnOff = false;
        }
    }
}
