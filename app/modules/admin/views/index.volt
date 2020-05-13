{{ get_doctype() }}
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>RE/MAX Design</title>
	{#
	{{ stylesheet_link("https://use.fontawesome.com/releases/v5.8.2/css/all.css", false) }}
	{{ stylesheet_link("https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&amp;display=swap", false) }}
	{{ stylesheet_link("css/general.css") }}
	{{ stylesheet_link("css/admin.css") }}
	#}

	{{ assets.outputCss() }}
	{{ assets.outputJs('header') }}
</head>
<body>
	{{ content() }}

	{{ assets.outputInlineJs() }}
	{{ assets.outputJs() }}
	{{ assets.outputJs('footer') }}
</body>
</html>
