let config;
let canal;
let lista;

moment.locale('es');

$( document ).ready(() => {
	$.getJSON( "config.json", datos => {
		config = datos
		setImmediate(conectar)

		$.get(`${config.url}/aprobadas`, datos => {
			lista = datos
			cargarMensajes()
		})

	})


})

function conectar(){
	canal = io.connect(config.url);

	canal.on("aprobada", datos => {

		lista.unshift(datos)
		$("#caja-mensajes").prepend(generarItem(datos))

	})
}

function cargarMensajes() {
	lista.forEach( item => {
		console.log(item)
		$("#caja-mensajes").append(generarItem(item))
	})
}

function generarItem( obj ) {
	console.log(obj)

	const $item = $("<div>")

	$item
		.addClass("item mb-4 bg-gray-200 p-2")
		.append($("<span>")
			.addClass("item--nombre block font-bold text-xl mb-0 uppercase")
			.text(obj.nombre)
			.append($("<span>")
				.addClass("item--hora block text-gray-500 text-sm mb-1")
				.text(moment(obj.creacion).format("h:m A"))))

		.append($("<span>")
			.addClass("item--texto block text-gray-700 text-base")
			.text(obj.texto))
		.append(
			$("<div>")
				.addClass("botones flex justify-end")
				.append(
					$("<button>")
						.addClass("item--contestar text-white text-center bg-gray-700 px-4 py-2")
						.text("Ocultar")
						.click(() => {
							contestarItem(obj.id)
							$item.addClass("oculto")
						})
				)
		)

	return $item
}

function contestarItem(id){
	console.log(id)
	$.ajax(`${config.url}/contestar`, {
		data : JSON.stringify({id}),
		contentType : 'application/json',
		type : 'POST',

	})
}
