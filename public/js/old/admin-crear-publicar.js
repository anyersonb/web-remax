if (typeof W == "undefined") {
	var W = window
}
// const W = window
if (typeof D == "undefined") {
	var D = document
}


W.addEventListener("load", WLoad)

function WLoad(evt) {
	console.log(URL);
	fetch(URL)
		.then( rpta => rpta.json() )
		.then( json => {
			console.debug(json);
			if (json.ok) {
				document.getElementById("previo").innerHTML = json.previo
				document.getElementById("id").textContent = json.datos.id;
				document.getElementById("nombre").textContent = json.difusion.anuncio.titulo;
				document.getElementById("estado").textContent = json.datos.effective_status;
				document.getElementById("mensaje").classList.add("ok");
				document.getElementById("mensaje").innerHTML = "Su anuncio está pendiente de revisión y estará listo para publicación dentro de las próximas 8 horas o antes. Los resultados del anuncio los podrá ver en la página de <a href='http://140.82.28.69/easya/admin'>STATUS.</a>";
				mostrar();
			}
			else{

				document.getElementById("mensaje").classList.add("error");
				document.getElementById("mensaje").textContent = json.error;
				document.getElementById("espera").classList.add("oculto");
			}
		})
}

function mostrar(){
	console.log(document.getElementById("previo").classList);
	document.getElementById("previo").classList.remove("oculto");
	document.getElementById("datos").classList.remove("oculto");
	document.getElementById("espera").classList.add("oculto");
}
