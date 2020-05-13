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
					<p>4 anuncios en Fb</p>
					<p>4 anuncios en Instagram</p>
					<p>Reportes personalizados</p>
				</div>
			</button>
		{{ endForm() }}

		{{form()}}
			{{ hidden_field('tipo', 'value': '2') }}
			<button type="submit" class="opcion proximamente">

				<div class="titulo">
					<h2>google ads display</h2>
				</div>
				<figure class="poster">{{image("img/poster-google.png")}}</figure>
				<div class="info">
					<p>4 anuncios en Google</p>
					<p>Reportes personalizados</p>
					<p>Optimización de campaña</p>
				</div>
			</button>
		{{ endForm() }}

		{{form()}}
			{{ hidden_field('tipo', 'value': '3') }}
			<button type="submit" class="opcion proximamente">

				<div class="titulo">
					<h2>automático</h2>
				</div>
				<figure class="poster">{{image("img/poster-google-facebook.png")}}</figure>
				<div class="info">
					<p>Anuncios ilimitados</p>
					<p>Reportes personalizados</p>
					<p>Alertas de contactos</p>
					<p>Avisos de renovación</p>
					<p>Optimización de campañas</p>
				</div>
			</button>
		{{ endForm() }}
	</div>

</article>
