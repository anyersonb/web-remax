let config;
let canal;
let lista;


$( document ).ready(() => {
	$.getJSON( "config.json", datos => {
		config = datos
		setImmediate(conectar)

		$.get(`${config.url}/mensajes`, datos => {
			lista = datos.map( ({id, nombre, texto}) => ({id, nombre, texto}) )
			cargarMensajes()
		})

		$("#btn-borrar").on("click", () =>{
			const rpta = confirm("Esta operación borrará todos los mensajes")

			if(rpta){
				const clave = "124578"
				$.ajax(`${config.url}/borrar`, {
					data : JSON.stringify({clave}),
					contentType : 'application/json',
					type : 'POST',

				})
				.then( () => {
					alert("Mensajes eliminados")
				})
			}

		})

	})



})


function conectar(){
	canal = io.connect(config.url);

	canal.on("enviada", datos => {

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
	const $item = $("<div>")

	$item
		.addClass("item mb-4 bg-gray-200 p-2")
		.append($("<span>")
			.addClass("item--nombre block font-bold text-xl mb-2 uppercase")
			.text(obj.nombre))
		.append($("<span>")
			.addClass("item--texto block text-gray-700 text-base")
			.text(obj.texto))
		.append(
			$("<div>")
				.addClass("botones flex justify-end")
				.append(
					$("<button>")
						.addClass("item--desaprobar text-white text-center bg-red-700 px-4 py-2")
						.text("Desaprobar")
						.click(() => {
							rechazarItem(obj.id)
							$item.addClass("oculto")
						}),
					$("<button>")
						.addClass("item--aprobar text-white text-center bg-green-700 px-4 py-2")
						.text("Aprobar")
						.click(() => {
							aprobarItem(obj.id)
							$item.addClass("oculto")
						})
				)
		)

	return $item
}

function aprobarItem(id){
	$.ajax(`${config.url}/aprobar`, {
		data : JSON.stringify({id}),
		contentType : 'application/json',
		type : 'POST',

	})
}


function rechazarItem(id){
	$.ajax(`${config.url}/rechazar`, {
		data : JSON.stringify({id}),
		contentType : 'application/json',
		type : 'POST',

	})
}
