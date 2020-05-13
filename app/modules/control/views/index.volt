{{ get_doctype() }}
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		{{ getTitle() }}
		{{ assets.outputCss() }}
		{{ assets.outputInlineCss() }}

		{% if( assets.exists('header') ) %}
			{{ assets.outputJs('header') }}
		{% endif %}
	</head>
	<body>
		<div id="pagina">
			<aside id="lateral">
				<!--
				<div class="logo">
					{{ image('http://remaxdesignperu.com /img/logo.png') }}
				</div>
				-->
				{{partial("menu")}}
			</aside>

			<main id="contenido">
				<div class="hero is-dark">
					<div class="hero-body">
						<div class="level">
							<div class="level-left">
								<div class="level-item">
									<h1 class="title">{{ titulo | default("") }}</h1>

								</div>
								<div class="level-item">
									<h2 class="subtitle">{{ subtitulo | default("") }}</h2>
								</div>
								<div class="level-item">
								</div>
							</div>
							<div class="level-right">
								{% if operaciones is defined %}
									{% for operacion in operaciones %}
										{{ controlTags.botonOperacion(operacion) }}
									{% endfor %}
								{% endif %}
							</div>
						</div>
						<nav class="breadcrumb is-small" aria-label="breadcrumbs">
							<ul>
								<li>{{ controlTags.enlaceRuta([
									"ruta":"control",
									"titulo":"Panel de Control",
									"icono": "home",
									"iconoClases": ["is-small"],
									"clases": ["has-text-light"]
								]) }}</li>
								<li>
									{{ controlTags.enlaceRuta([
										"ruta":[
											"for": "controlController",
											"controller": router.getControllerName()
										],
										"titulo":router.getControllerName() | capitalize,
										"icono": "flag",
										"iconoClases": ["is-small"],
										"clases": ["has-text-light"]
									]) }}
								</li>
								<li class="is-active"><a href="#" class="has-text-light" aria-current="page">{{ router.getActionName()| capitalize }}</a></li>
							</ul>
						</nav>
					</div>
				</div>

				<section class="section">
				{{ content() }}
				</section>
			</main>

			<footer id="pie" class="panel is-dark">
				<div class="panel-block">
				{% block pie %}
				<p>&copy;2019</p>
				{% endblock %}
				</div>
			</footer>
		</div>


		{{ assets.outputJs() }}
		{{ assets.outputJs() }}
		{% if( assets.exists('footer') ) %}
			{{ assets.outputJs('footer') }}
		{% endif %}
		{{ assets.outputInlineJs() }}
	</body>
</html>
