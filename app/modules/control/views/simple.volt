{{ get_doctype() }}
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Sistema</title>
		{{ assets.outputCss() }}
		{{ assets.outputInlineCss() }}

		{% if( assets.exists('header') ) %}
			{{ assets.outputJs('header') }}
		{% endif %}
	</head>
	<body>
		{% block pagina %}
			{{ content() }}
		{% endblock %}


		{{ assets.outputJs() }}
		{{ assets.outputJs() }}
		{% if( assets.exists('footer') ) %}
			{{ assets.outputJs('footer') }}
		{% endif %}
		{{ assets.outputInlineJs() }}
	</body>
</html>
