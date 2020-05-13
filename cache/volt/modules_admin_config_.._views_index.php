<?= $this->tag->getDoctype() ?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>RE/MAX Design</title>
	

	<?= $this->assets->outputCss() ?>
	<?= $this->assets->outputJs('header') ?>
</head>
<body>
	<?= $this->getContent() ?>

	<?= $this->assets->outputInlineJs() ?>
	<?= $this->assets->outputJs() ?>
	<?= $this->assets->outputJs('footer') ?>
</body>
</html>
