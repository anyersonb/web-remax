<div id="pagina">
	<header id="encabezado">{{partial("header")}}</header>
	<main id="sistema">
		<aside id="lateral">
			{{partial("lateral", ['activo': 'datos'])}}
		</aside>
		<section id="superior">
			<h1>{{titulo|default('')}}</h1>
			<div class="acciones">
			</div>
		</section>
		<section id="contenido">
			{{content()}}
			<footer id="pie">{{partial("footer")}}</footer>
		</section>
	</main>
</div>
