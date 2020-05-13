<?= $this->tag->getDoctype() ?>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Sistema</title>
		<?= $this->assets->outputCss() ?>
		<?= $this->assets->outputInlineCss() ?>

		<?php if (($this->assets->exists('header'))) { ?>
			<?= $this->assets->outputJs('header') ?>
		<?php } ?>
	</head>
	<body>
		
			<?= $this->getContent() ?>
		


		<?= $this->assets->outputJs() ?>
		<?= $this->assets->outputJs() ?>
		<?php if (($this->assets->exists('footer'))) { ?>
			<?= $this->assets->outputJs('footer') ?>
		<?php } ?>
		<?= $this->assets->outputInlineJs() ?>
	</body>
</html>
