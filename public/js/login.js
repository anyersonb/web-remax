var D = document
var W = window


var openbox=false;

W.addEventListener("load", evt => {
	//inicializarFiltros()
	var btn_login = document.getElementById("btn_login");
	if(document.getElementById("btn_login")!=null){
		document.getElementById("btn_login").onclick = onClickLogin;
	}
	
})

var portada

function onClickLogin(){
	if(openbox){
		var element = document.getElementById("btn_login");
		element.classList.remove("active");
		var element = document.getElementById("box_login");
		element.classList.remove("view");
		openbox = false;
	}else{
		var element = document.getElementById("btn_login");
		element.classList.add("active");
		var element = document.getElementById("box_login");
		element.classList.add("view");
		openbox = true;
	}
	
	//box_login_sup
	//alert("TEST");
}
function inicializarFiltros() {
	/*
	const listaPMF = new Jets({
		contentTag: "#tutoriales .tutoriales_content",
		manualContentHandling: function(item) {
			console.debug(item)
			let cat = item.getAttribute("data-categoria")
			if (cat != null) {
				return cat
			} else {
				return ""
			}
		},
		callSearchManually: true
	})

	const filtros = D.querySelector("#tutoriales .filtros")
	filtros.addEventListener("click", evt => {
		filtros.classList.add("activo")
		console.log(evt.target)
		filtros.querySelectorAll("button").forEach(boton => {
			boton.classList.remove("activo")
		})

		const boton = evt.target
		boton.classList.add("activo")
		listaPMF.search(boton.dataset.id)
	})
	*/
}
