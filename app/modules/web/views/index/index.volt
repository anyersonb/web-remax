<style>
.lightbox {
  background-color: rgba(0, 0, 0, 0.8);
  overflow: scroll;
  position: fixed;
  display: none;
  z-index: 80;
  bottom: 0;
  right: 0;
  left: 0;
  top: 0;
}
.lightbox-container {
  position: relative;
  max-width: 960px;
  margin: 7% auto;
  display: block;
  padding: 0 3%;
  height: auto;
  z-index: 10;
}
@media screen and (max-width: 768px) {
  .lightbox-container {
    margin-top: 10%;
  }
}
@media screen and (max-width: 414px) {
  .lightbox-container {
    margin-top: 13%;
  }
}
.lightbox-content {
  box-shadow: 0 1px 6px rgba(0, 0, 0, 0.7);
}
.lightbox-close {
  text-transform: uppercase;
  background: transparent;
  position: absolute;
  font-weight: 300;
  font-size: 12px;
  display: block;
  border: none;
  color: white;
  top: -22px;
  right: 3%;
}
.video-container {
  padding-bottom: 56.25%;
  position: relative;
  padding-top: 30px;
  overflow: hidden;
  height: 0;
}
.video-container iframe,
.video-container object,
.video-container embed {
  position: absolute;
  height: 100%;
  width: 100%;
  left: 0;
  top: 0;
  z-index: 999;
}
/* IGNORE FORM THIS POINT ON */
body {
  background: #efefef;
}
#container {
  border-radius: 4px;
  max-width: 300px;
  height: auto;
  padding: 50px;
  background: white;
  margin: 100px auto;
}
#playme {
  background: #007fed;
  text-transform: uppercase;
  font-weight: 300;
  border: none;
  color: white;
  padding: 10px 15px;
  display: inline-block;
  font-size: 14px;
  margin: 0;
}

</style>


<div id="video" class="lightbox" onclick="hideVideo()">
  <div class="lightbox-container">
    <div class="lightbox-content">
      <button onclick="hideVideo()" class="lightbox-close">
        Cerrar | ✕
      </button>
      <div class="video-container">
        <iframe id="youtube" width="960" height="540" src="" frameborder="0" allowfullscreen></iframe>
      </div>

    </div>
  </div>
</div>

					<!--
					<a href="#" class="btn">
						<div class="square">
								<img src="img/casa.png" width="20px"/>
						</div>
						<div class="text">
							DESCUBRE RXART
						</div>
					</a>
					-->
<div id="portada" class="glide">
		<div class="glide__track" data-glide-el="track">
			<div class="glide__slides">
				{% for banner in banners %}
				<div class="cuadro glide__slide">
					<img class="fondo" src="/system/banners/imagen/{{banner.id}}" alt="">
					<div class="sumilla">
						<div class="mini-linea"></div>
						<div class="texto">{{banner.nombre}}</div>
					</div>

					<span class="main_message">{{banner.descripcion}}</span>
				</div>
				{% endfor %}
			</div>
		</div>


		<div class="slider_menu">
			<div class="arrows" data-glide-el="controls">
				<button class="arrow_left" data-glide-dir="<" type="button">
					<img src="img/left_arrow.png" width="30px"/>
				</button>
				<button class="arrow_right" data-glide-dir=">" type="button">
					<img src="img/right_arrow.png" width="30px"/>
				</button>
			</div>
			<div class="menu" data-glide-el="controls[nav]">
				{% set count = 0 %}
				{% for banner in banners %}
				<div class="item" data-glide-dir="=<?php echo $count; ?>">
					<a href="#">{{banner.titulo}}</a>
					<div class="linea_azul"></div>
				</div>
				<?php $count++; ?>
				{% endfor %}
			</div>
		</div>


	</div>
	<!--
	<div id="slider">
		<div class="text_description">

			<div class="content">
				<div class="in">

					<div class="sumilla">
						<div class="mini-linea"></div>
						<div class="texto">DISEÑO PARA AGENTES</div>
					</div>

					<span class="main_message">Diseña tus<br/>
					presentaciones<br/>
					como PRO</span>


						<a href="#" class="btn">
							<div class="square">
									<img src="img/casa.png" width="20px"/>
							</div>
							<div class="text">
								DESCUBRE RXART
							</div>
						</a>
				</div>
			</div>
		</div>
		<div class="gray_square_bottom">
			<div class="slider_menu">
				<div class="arrows">
					<div class="arrow_left">
						<img src="img/left_arrow.png" width="30px"/>
					</div>
					<div class="arrow_right">
						<img src="img/right_arrow.png" width="30px"/>
					</div>
				</div>
				<div class="menu">
					<div class="item">
						<a href="#">¿Qué es?</a>
						<div class="linea_azul"></div>
					</div>
					<div class="item">
						<a href="#">¿Para que sirve?</a>
						<div class="linea_azul"></div>
					</div>
					<div class="item">
						<a href="#">¿Como funciona?</a>
						<div class="linea_azul"></div>
					</div>
					<div class="item">
						<a href="#">¿Totalmente gratis?</a>
						<div class="linea_azul"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	-->
	<div id="benficios" class="section">
		<span class="sumilla">CREA TUS DISEÑOS PUBLICITARIOS EN FORMA INMEDIATA</span>
		<h1>Beneficios</h1>
		<div class="linea_azul"></div>
		<div class="benficios_wrapper" id="beneficios_slider">

			<div class="benficios_content">
				<div class="box info">
					<div class="small_box">
						<div class="small_box_content">
							<span class="titulo">
								<img src="img/icono-beneficio-azul.svg" alt="" class="icono">
								<span>Plantillas listas</span>
							</span>
							<span class="descripcion">Utiliza nuestras plantillas pre diseñadas y ten listos en minutos los diseños que necesitas para promocionar tu negocio en las diferentes plataformas. 100% listas para usar.
</span>
						</div>
					</div>
					<div class="small_box red">
						<div class="small_box_content">
							<span class="titulo">
								<img src="img/icono-beneficio-rojo.svg" alt="" class="icono">
								<span>Optimizadas para Facebook</span>
							</span>
							<span class="descripcion">Olvídate de ajustar tus diseños en forma manual. Con RE/MAX DESIGN tendrás tus diseños optimizados desde el primer momento, asegurando así un máximo alcance en Facebook.</span>
						</div>

					</div>
				</div>

				{% for beneficio in beneficios %}
				<div class="box">
					<figure><img src="/system/beneficios/imagen/{{beneficio.id}}/330" alt=""></figure>
				</div>
				{% endfor %}

			</div>
		</div>
	</div>

	<div id="instrucciones" class="glide">
		<div class="titulo">tutoriales RE/MAX DESIGN</div>
		<div class="glide__track" data-glide-el="track">
			<div class="glide__slides">
				{% set count = 1 %}
				{% for tutorial in tutoriales %}
				<div class="cuadro glide__slide">
					<img class="fondo" src="/system/tutoriales/imagen/{{tutorial.id}}" alt="">
					<div class="info">
						<span class="big_number"><?php echo ($count<10)?'0':''; ?><?php echo $count; ?></span>
						<span>{{tutorial.titulo}}</span>
						<span class="descripcion">{{tutorial.descripcion}}</span>

						{% if tutorial.youtube %}
						<a href="javascript:revealVideo('{{tutorial.youtube}}');" class="btn">
							<div class="square">
									<img src="img/casa.png" width="20px"/>
							</div>
							<div class="text">
								MIRA EL VIDEO
							</div>
						</a>
						{% endif %}

						{% if tutorial.pdf %}
						<a href="{{tutorial.pdf}}" target="_blank" class="btn">
							<div class="text" style="height:40px">
								DESCARGAR EL PDF
							</div>
						</a>
						{% endif %}
					</div>
				</div>
				<?php $count++; ?>
				{% endfor %}


			</div>
		</div>
		<div class="controles">
			<div class="enlaces" data-glide-el="controls[nav]">
				{% set count = 1 %}
				{% for tutorial in tutoriales %}
				<button type="button" data-glide-dir="=0"><?php echo ($count<10)?'0':''; ?><?php echo $count; ?></button>
				<?php $count++; ?>
				{% endfor %}
			</div>
			<div class="arrows" data-glide-el="controls">
				<button class="arrow_left" data-glide-dir="<" type="button">
					<img src="img/left_arrow.png" width="30px"/>
				</button>
				<button class="arrow_right" data-glide-dir=">" type="button">
					<img src="img/right_arrow.png" width="30px"/>
				</button>
			</div>
		</div>
	</div>

	<!--
	<div id="instructivo">
		<div class="item">
			<div class="info_wrapper">
				<div class="info">
					<span class="big_number">01</span>
					<span>Creando un aviso de facebook</span>
					<span class="descripcion">Loren ipsum dolor sit amet consectetur adipsing elit, inceptos mi</span>
					<a href="#" class="btn">
							<div class="square">
									<img src="img/casa.png" width="20px"/>
							</div>
							<div class="text">
								MIRA EL VIDEO
							</div>
						</a>

						<a href="#" class="btn">
							<div class="square">
									<img src="img/casa.png" width="20px"/>
							</div>
							<div class="text">
								MIRA EL VIDEO
							</div>
						</a>

				</div>
			</div>
			<div class="imagen"></div>
		</div>

	</div>
	-->

	<div id="faq">
		<h1>PREGUNTAS FRECUENTES</h1>
		<div class="linea_azul"></div>
		<!--
		<div class="filtros">
			<button type="button" data-id="1">categoria preguntas 1</button>
			<button class="" type="button" data-id="2">categoria preguntas 2</button>
			<button type="button" data-id="3">categoria preguntas 3</button>

		</div>
		-->
		<div class="faq_content">


			{% set account = 1 %}
			{% for preguntasfrecuente in preguntasfrecuentes %}
			<div class="box" data-categoria="1">
				<div class="alarm"></div>
				<span class="numero"><?php echo ($account<10)?'0':''; ?><?php echo $account; ?></span>
				<span class="pregunta">{{preguntasfrecuente.pregunta}}</span>
				<span class="descripcion">{{preguntasfrecuente.respuesta}}</span>
			</div>
			<?php $account++; ?>
			{% endfor %}



		</div>
	</div>
