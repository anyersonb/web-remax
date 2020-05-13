<div id="plantillas" class="section">
		<h5>CREA TU ANUNCIO</h5>
		<h1>Plantillas</h1>
		<div class="plantillas_wrapper" id="beneficios_slider">
			<div class="plantillas_content">
				<div class="box">
					<figure><img src="/img/p1.jpg" alt=""></figure>
				</div>
				{{ link_to('admin/clientes/disenos/#/plantillas', "<figure>" ~ image("/img/p2.jpg") ~ "</figure>", "class":"box" ) }}
				{{ link_to('admin/clientes/disenos/#/plantillas', "<figure>" ~ image("/img/p3.jpg") ~ "</figure>", "class":"box deshabilitado" ) }}
			</div>
		</div>
	</div>

<style>

.deshabilitado{
	opacity: 0.5;
	cursor: not-allowed;
}
</style>
