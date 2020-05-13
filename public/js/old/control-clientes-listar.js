const columnas = [
	{ title: "ID", sorter: "number", width: 60 },
	{ title: "Nombre Completo" },
	{ title: "Correo Electrónico" },
	{ title: "Anuncios", align: "right" },
	{
		title: "",
		formatter: "html",
		cellClick: accionesClick
	}
]

const lista = new Tabulator("#lista", {
	tooltips: true,
	layout: "fitColumns",
	columns: columnas
})

function accionesClick(evt, cell) {
	console.debug(evt.target)
	/* if (event.target.matches('.modal-open')) {
		// Run your code to open a modal
	} */
}

function uno() {
	console.debug("uno", arguments)
}
