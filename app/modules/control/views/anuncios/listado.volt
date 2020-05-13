<h1>Anuncios</h1>

<div id="lista" class="ag-theme-balham"></div>

<script type="text/javascript" charset="utf-8">

// Los encabezados
const columnas = [
	{headerName: "ID", field: "id"},
	{headerName: "Tipo", field: "tipo"},
	{headerName: "Cliente", field: "cliente"},
	{
		cellRenderer : function(params){
			return '<button onClick="botonClick()">clic</button>'
		}
	}
];

// Los datos
const filas = [
	{% for anuncio in anuncios %}
		{
			id:{{anuncio.id}},
			tipo:"{{anuncio.Tipo.titulo}}",
			cliente:"{{anuncio.Cliente.nombreCompleto}}"
		}
	{% endfor %}
];

const opciones = {
	columnDefs: columnas,
	rowData: filas
};

const lista = document.querySelector('#lista');

const grid = new agGrid.Grid(lista, opciones);

function botonClick(){
	console.log("CLICK");
}


</script>
