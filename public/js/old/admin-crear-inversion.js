if (typeof W == "undefined") {
	var W = window
}
// const W = window
if (typeof D == "undefined") {
	var D = document
}

W.addEventListener("load", WLoad)

const inicio =  D.querySelector("[name=inicio]")

const $tiempoRango = D.getElementById("slider-tiempo")
const $tiempoTexto = D.querySelector("[name=tiempo]")


const $montoRango = D.getElementById("slider-monto")
const $montoTexto = D.querySelector("[name=monto]")


const $edadRango = D.getElementById("slider-edad")
const $edadTexto = D.querySelector("[name=edad]")

const $diario = D.getElementById("diario")

const $lugares = D.getElementById("lugares")
var tagLugares;
var tagLugaresAbortController;
var listaLugares;
var listadoLugares;
var tetherLugares;

function WLoad(evt) {
	flatpickr.localize(flatpickr.l10ns.es);
	flatpickr(inicio,{
		altInput: true,
		altFormat: "j \\de F \\de Y",
		dateFormat: "Y-m-d",
		minDate: "today",
	});


	noUiSlider.create($tiempoRango, {
		start: $tiempoTexto.value,
		connect: true,
		tooltips: wNumb({suffix: ' días', decimals: 0}),
		step: 1,
		range: {
			'min': 5,
			'max': 90
		},
		pips: {
			mode: 'values',
			values: [5, 15, 30, 45, 60, 75, 90],
			density: 5
		},
		format: wNumb({
			decimals: 0
		}),
	});

	noUiSlider.create($montoRango, {
		start: $montoTexto.value,
		connect: true,
		tooltips: wNumb({prefix: '$ ', decimals: 0}),
		step: 5,
		range: {
			'min': 50,
			'max': 1000
		},
		pips: {
			mode: 'count',
			values: 6,
			density: 4,
			stepped: true,
			format: wNumb({
				decimals: 0,
				prefix: '$'
			})
		},
		format: wNumb({
			decimals: 0
		}),
	});


	noUiSlider.create($edadRango, {
		start: JSON.parse($edadTexto.value),
		step: 1,
		connect: true,
		range: {
			'min': 18,
			'max': 65
		},
		margin: 5,
		behaviour: 'drag-tap',
		tooltips: [wNumb({decimals: 0}),wNumb({decimals: 0})],
		pips: {
			mode: 'steps',
			filter: (value, type) => (value % 5) ? 0 : 1,
			format: wNumb({
				decimals: 0,
			})
		},
	});


	$tiempoRango.noUiSlider.on('update', function (values, handle) {
		$tiempoTexto.value = values[0];
	});

	$tiempoRango.noUiSlider.on('change', function (values, handle) {
		minimo = Math.ceil((( values[0] ) *  6) / 5 ) * 5;

		$montoRango.noUiSlider.updateOptions({
			range: {
				'min': minimo,
				'max': 1000
			}
		});

		$tiempo = values[0];
		$monto = $montoRango.noUiSlider.get();

		$diario.textContent = Math.floor($monto/$tiempo);
	});

	$montoRango.noUiSlider.on('update', function (values, handle) {
		$montoTexto.value = values[0];
	});

	$montoRango.noUiSlider.on('change', function (values, handle) {

		$monto = values[0];
		$tiempo = $tiempoRango.noUiSlider.get();

		$diario.textContent = Math.floor($monto/$tiempo);
	});

	$edadRango.noUiSlider.on('update', function (values, handle) {
		$edadTexto.value = JSON.stringify(values);
		// console.log(JSON.stringify(values));
	});

	$('#inputLugares').selectize({
		valueField: "value",
		labelField: "value",
		searchField: "value",
		delimiter: ';',
		create: false,
		persist: false,
		load: function(query, callback) {
			if (!query.length) return callback();
			$.ajax({
				url: 'http://easyanuncios.com/system/api/ciudades/?nombre=' + encodeURIComponent(query),
				type: 'GET',
				error: function() {
					callback();
				},
				success: function(res) {
					callback(res.suggestions);
				}
			});
		}
	});

	var xhr;
	var selectDepartamentos, $selectDepartamentos;
	var selectProvincias, $selectProvincias;
	var selectDistritos, $selectDistritos;
	var departamento, provincia

	$selectDepartamentos = $('#selectDepartamentos').selectize({
		onChange: function(valor) {
			departamento = numeral(valor).value();
			selectProvincias.setValue("00", false);
			selectProvincias.disable();
			selectProvincias.clearOptions();

			selectDistritos.setValue("00", false);

			if (!departamento) return;
			selectProvincias.load(function(callback) {
				xhr && xhr.abort();
				console.log(`${API}provincias/${departamento}`);
				xhr = $.ajax({
					url: API + 'provincias/'+departamento,
					success: function(results) {
						console.debug(results);
						selectProvincias.enable();
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
		}
	});

	$selectProvincias = $('#selectProvincias').selectize({
		valueField: "id",
		labelField: "nombre",
		searchField: "nombre",
		onChange: function(valor) {
			provincia = numeral(valor).value();
			selectDistritos.setValue("00");
			selectDistritos.disable();
			if (!provincia) return;
			console.debug(provincia);
			selectDistritos.clearOptions();
			selectDistritos.load(function(callback) {
				xhr && xhr.abort();
				console.log(API + `distritos/${departamento}/${provincia}`);
				xhr = $.ajax({
					url: API + `distritos/${departamento}/${provincia}`,
					success: function(results) {
						console.debug(results);
						selectDistritos.enable();
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
		}
	});

	$selectDistritos = $('#selectDistritos').selectize({
		valueField: "id",
		labelField: "nombre",
		searchField: "nombre"
	});

	selectDepartamentos = $selectDepartamentos.get(0).selectize;
	selectProvincias = $selectProvincias.get(0).selectize;
	selectDistritos = $selectDistritos.get(0).selectize;

}
