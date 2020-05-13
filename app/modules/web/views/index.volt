{{ get_doctype() }}
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>RE/MAX Design</title>

		{{ assets.outputCss() }}
		{{ assets.outputJs('header') }}

	</head>
	<body>

		{{ content() }}
		{{ assets.outputJs('footer') }}

	</body>
</html>
