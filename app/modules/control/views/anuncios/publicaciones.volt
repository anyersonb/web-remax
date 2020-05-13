<section class="hero is-dark">
	<div class="hero-body">
		<div class="container">
		<h1 class="title">Publicaciones del anuncio {{anuncio.id}}-{{anuncio.titulo}}</h1>
		</div>
	</div>
</section>

<section class="section" >
	<table id="lista" class="table is-fullwidth is-hoverable is-striped is-narrow">
		<thead>
			<tr>
				<th>ID</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{% for publicacion in anuncio.Difusiones %}
				<tr>
					<td>{{publicacion.id}}</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			{% endfor %}
		</tbody>
	</table>
</section>
