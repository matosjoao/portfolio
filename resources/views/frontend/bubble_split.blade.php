
@section('css')
    <style>
		#game
		{
			width:800px;
			height:550px;
			margin-left: auto;
    		margin-right: auto;
		}
	</style>
@endsection
@section('scripts')
    <!-- Game Scripts -->
    <script src="{{ asset('projects/bubble_split/libsPhaser/phaser.min.js') }}" defer></script>
    <script src="{{ asset('projects/bubble_split/js/init.js') }}" defer></script>
    <script src="{{ asset('projects/bubble_split/js/preload.js') }}" defer></script>
    <script src="{{ asset('projects/bubble_split/js/titulojogo.js') }}" defer></script>
    <script src="{{ asset('projects/bubble_split/js/ojogo.js') }}" defer></script>
    <script src="{{ asset('projects/bubble_split/js/bola.js') }}" defer></script>

    <script>
        window.onload = () => {
            var game = new Phaser.Game(800,550, Phaser.CANVAS, 'game');
            game.state.add("Init",init);
            game.state.add("Preload",preload);
            game.state.add("titulojogo",titulojogo);
            game.state.add("oJogo",oJogo);
            game.state.start("Init");
        };
    </script>
@endsection
<x-project-layout>
    <div id="game"></div>
</x-project-layout>
