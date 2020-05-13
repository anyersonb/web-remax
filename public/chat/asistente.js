let config;
let nombre = "asistente";

$( document ).ready(() => {
	$.getJSON( "config.json", datos => {
		config = datos
		// setImmediate(conectar)

	})

	$("#btn-asignar").on("click", () => {
		nombre = $("#txt-nombre").val().trim()
		$("#lbl-nombre").text(nombre)
		$("#caja-nombre").addClass("oculto")
		$("#caja-mensaje").removeClass("oculto")
	})

	$("#btn-enviar").on("click", () => {
		$.ajax(`${config.url}/enviar`, {
			data : JSON.stringify({
					nombre,
					texto: $("#txt-mensaje").val().trim()
				}),
			contentType : 'application/json',
			type : 'POST',

		})
		.done( rpta => {
			console.log(rpta)
			$("#txt-mensaje").val("")
			$("#caja-mensaje").addClass("oculto")
			$("#caja-respuesta").removeClass("oculto")
		})
	})

	$("#btn-volver").on("click", () => {
		$("#txt-mensaje").val("")
		$("#caja-respuesta").addClass("oculto")
		$("#caja-mensaje").removeClass("oculto")
	})

})
