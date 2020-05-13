<article id="crear">
	<div class="elige">
		{{form()}}
			{{ hidden_field('tipo', 'value': '1') }}
			<button type="submit" class="opcion">
				<div class="titulo">
					<h2>Facebook Instagram</h2>
				</div>
				<figure class="poster">{{image("img/poster-facebook.png")}}</figure>
				<div class="info">
					<p>Lorem ipsum dolor sit amet, elit quisque faucibus varius ut mauris. Consequat varius quasi pulvinar metus curabitur, quia erat,</p>
				</div>
			</button>
		{{ endForm() }}

		{{form()}}
			{{ hidden_field('tipo', 'value': '2') }}
			<button type="submit" class="opcion">

			<div class="titulo">
				<h2>google ads display</h2>
			</div>
			<figure class="poster">{{image("img/poster-google.png")}}</figure>
			<div class="info">
				<p>Aliqua commodo consectetur voluptate Lorem. Irure esse duis qui ex minim ut enim duis. Aute deserunt consectetur adipisicing mollit tempor in officia dolore nisi sint.</p>
			</div>
			</button>
		{{ endForm() }}

		{{form()}}
			{{ hidden_field('tipo', 'value': '3') }}
			<button type="submit" class="opcion">

			<div class="titulo">
				<h2>automático</h2>
			</div>
			<figure class="poster">{{image("img/poster-google-facebook.png")}}</figure>
			<div class="info">
				<p>Fugiat laboris esse eu voluptate in tempor officia voluptate exercitation deserunt quis reprehenderit irure.</p>
			</div>
			</button>
		{{ endForm() }}
	</div>

</article>
