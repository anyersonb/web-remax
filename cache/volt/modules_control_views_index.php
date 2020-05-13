<?= $this->tag->getDoctype() ?>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<?= $this->tag->gettitle() ?>
		<?= $this->assets->outputCss() ?>
		<?= $this->assets->outputInlineCss() ?>

		<?php if (($this->assets->exists('header'))) { ?>
			<?= $this->assets->outputJs('header') ?>
		<?php } ?>
	</head>
	<body>
		<div id="pagina">
			<aside id="lateral">
				<!--
				<div class="logo">
					<?= $this->tag->image(['http://remaxdesignperu.com /img/logo.png']) ?>
				</div>
				-->
				<?= $this->partial('menu') ?>
			</aside>

			<main id="contenido">
				<div class="hero is-dark">
					<div class="hero-body">
						<div class="level">
							<div class="level-left">
								<div class="level-item">
									<h1 class="title"><?= (empty($titulo) ? ('') : ($titulo)) ?></h1>

								</div>
								<div class="level-item">
									<h2 class="subtitle"><?= (empty($subtitulo) ? ('') : ($subtitulo)) ?></h2>
								</div>
								<div class="level-item">
								</div>
							</div>
							<div class="level-right">
								<?php if (isset($operaciones)) { ?>
									<?php foreach ($operaciones as $operacion) { ?>
										<?= $this->controlTags->botonOperacion($operacion) ?>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
						<nav class="breadcrumb is-small" aria-label="breadcrumbs">
							<ul>
								<li><?= $this->controlTags->enlaceRuta(['ruta' => 'control', 'titulo' => 'Panel de Control', 'icono' => 'home', 'iconoClases' => ['is-small'], 'clases' => ['has-text-light']]) ?></li>
								<li>
									<?= $this->controlTags->enlaceRuta(['ruta' => ['for' => 'controlController', 'controller' => $this->router->getControllerName()], 'titulo' => ucwords($this->router->getControllerName()), 'icono' => 'flag', 'iconoClases' => ['is-small'], 'clases' => ['has-text-light']]) ?>
								</li>
								<li class="is-active"><a href="#" class="has-text-light" aria-current="page"><?= ucwords($this->router->getActionName()) ?></a></li>
							</ul>
						</nav>
					</div>
				</div>

				<section class="section">
				<?= $this->getContent() ?>
				</section>
			</main>

			<footer id="pie" class="panel is-dark">
				<div class="panel-block">
				
				<p>&copy;2019</p>
				
				</div>
			</footer>
		</div>


		<?= $this->assets->outputJs() ?>
		<?= $this->assets->outputJs() ?>
		<?php if (($this->assets->exists('footer'))) { ?>
			<?= $this->assets->outputJs('footer') ?>
		<?php } ?>
		<?= $this->assets->outputInlineJs() ?>
	</body>
</html>
