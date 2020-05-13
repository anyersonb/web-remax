<section class="hero is-light">
	<div class="hero-body">
		<div class="container">
			<h1 class="title">{{ cliente.nombreCompleto }}</h1>
			<table class="table is-hoverable is-narrow">
				<tbody>
					<tr>
						<td>Email:</td>
						<td>{{ cliente.correo }}</td>
					</tr>
					<tr>
						<td>Celular:</td>
						<td>{{ cliente.celular }}</td>
					</tr>
					<tr>
						<td>Nombre de usuario:</td>
						<td>{{ cliente.alias }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>

<section class="section">

	<h2 class="title">Anuncios de {{ cliente.nombre }}</h2>
	<table class="table is-fullwidth is-hoverable is-striped is-narrow">

		<thead>
			<tr>
				<th>ID</th>
				<th>Titulo</th>
				<th>Tipo</th>
			</tr>
		</thead>
		<tbody>
		{% for anuncio in cliente.Anuncios %}
			<tr>
				<td>{{anuncio.id}}</td>
				<td>{{anuncio.titulo}}</td>
				<td>{{anuncio.Tipo.titulo}}</td>
			</tr>
		{% endfor %}
		</tbody>
	</table>
</section>
