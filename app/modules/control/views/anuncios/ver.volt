
<div class="level">
	<div class="level-left">
		<h2 class="title">{{anuncio.titulo}}</h2>
	</div>
	<div class="level-right">

		<div class="buttons">

			{% switch  anuncio.estado %}
				{% case "Creado" %}
					{{ linkTo([
						"action": [
							"for" : "controlControllerAction",
							"controller" : "anuncios",
							"action" : "rechazar",
							"params" : anuncio.id
						],
						"title":"Rechazar " ~ anuncio.titulo,
						"text":"Rechazar",
						"class":"navbar-item button is-text"
					])}}

					{{ linkTo([
						"action": [
							"for" : "controlControllerAction",
							"controller" : "anuncios",
							"action" : "aprobar",
							"params" : anuncio.id
						],
						"title":"Aprobar " ~ anuncio.titulo,
						"text":"Aprobar",
						"class":"button is-dark"
					])}}
					{% break %}

				{% case "Aprobado" %}


					{% break %}
			{% endswitch  %}
		</div>
	</div>
</div>

<div class="card">
<article class="media card-content">
	<div class="media-left">
		<figure class="image previo">
			<img src="{{ url("system/anuncios/imagen/" ~ anuncio.id)}}" alt="">
		</figure>
	</div>
	<div class="media-content">
		<div class="content">
			<p>
				<strong>Tipo</strong>&nbsp;
				<span class="tag">{{anuncio.Tipo.titulo}}</span>
			</p>
			<p>
				<strong>Cliente</strong>&nbsp;
				<span>{{anuncio.Cliente.nombreCompleto}}</span>
			</p>
			<p>
				<strong>Estado</strong>&nbsp;
				<span class="tag">{{anuncio.estado}}</span>
			</p>
			<p>
				<strong>Descripción</strong>&nbsp;
				<span>{{anuncio.descripcion}}</span>
			</p>
			<p>
				<strong>Enlace</strong>&nbsp;
				<span>
					<a href="{{anuncio.enlace}}" target="_blank">{{anuncio.descripcion}} {{controlTags.featherIcon("external-link", ["is-small"])}}</a>
				</span>
			</p>
		</div>
	</div>
</article>
<div class="level card-content has-text-white has-background-dark">
	<div class="level-left">
		<h3 class="level-item is-size-4">Campañas</h3>
	</div>
	<div class="level-right">

	</div>
</div>

<div class="card-content">
<table class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th>Inicio</th>
			<th>Duración</th>
			<th>Monto</th>
			<th>Estado</th>
		</tr>
	</thead>
	<tbody>
	{% for campagna in anuncio.Campagnas %}
		<tr>
			<td>{{campagna.inicio}}</td>
			<td>{{campagna.tiempo}} días</td>
			<td>S/ {{campagna.monto}}</td>
			<td>{{campagna.estado}}</td>
		</tr>
	{% endfor %}
	</tbody>
</table>
</div>

</div>
