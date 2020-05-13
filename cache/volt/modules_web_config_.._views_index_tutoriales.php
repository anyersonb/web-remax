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
.play_link{
	color:white;
	font-family: "montserratbold";
	font-size: 12px;
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
<div id="tutoriales">
		<h1>TUTORIALES</h1>
		<div class="linea_azul"></div>
		<!--<div class="filtros">
			<button type="button" data-id="1">Categoria 1</button>
			<button class="" type="button" data-id="2">Categoria 2</button>
			<button type="button" data-id="3">Categoria 3</button>

		</div>
		-->
		<div class="tutoriales_content">
			<?php foreach ($tutoriales as $tutorial) { ?>
			<div class="box blue" data-categoria="1">
				<div class="bloque1"></div>
				<div class="bloque2" style="background-image: url(/system/tutoriales/imagen/<?= $tutorial->id ?>);"></div>
				<div class="info">
					<h2><?= $tutorial->titulo ?></h2>
					<div class="desc"><?= $tutorial->descripcion ?></div>
					<div class="play_link_content">

						<?php if ($tutorial->youtube) { ?>
						<a href="javascript:revealVideo('<?= $tutorial->youtube ?>');" class="play_link">PLAY</a>
						<img src="img/ico_play.png" width="14px"/>
						<?php } ?>
					</div>

					<?php if ($tutorial->pdf) { ?>
					<a class="play_link" href="<?= $tutorial->pdf ?>" target="_blank">VER PDF</a>
					<?php } ?>
				</div>
			</div>
			<?php } ?>


		</div>
	</div>
