if (typeof W == "undefined") {
	var W = window
}
// const W = window
if (typeof D == "undefined") {
	var D = document
}

flatpickr.localize(flatpickr.l10ns.es);

W.addEventListener("load", WLoad)

const inicio =  D.querySelector("[name=inicio]")

const $tiempoRango = D.getElementById("slider-tiempo")
const $tiempoTexto = D.querySelector("[name=tiempo]")


const $montoRango = D.getElementById("slider-monto")
const $montoTexto = D.querySelector("[name=monto]")
console.debug($montoTexto);
function WLoad(evt) {
	flatpickr(inicio,{
		altInput: true,
		altFormat: "j \\de F \\de Y",
		dateFormat: "Y-m-d",
		minDate: "today",
	});


	noUiSlider.create($tiempoRango, {
		start: 10,
		connect: true,
		tooltips: true,
		step: 1,
		range: {
			'min': 10,
			'max': 90
		},
		format: wNumb({
			decimals: 0
		}),
	});

	$tiempoRango.noUiSlider.on('update', function (values, handle) {
		$tiempoTexto.value = values[0];
	});

	noUiSlider.create($montoRango, {
		start: 50,
		connect: true,
		tooltips: true,
		step: 10,
		range: {
			'min': 50,
			'max': 500
		},
		format: wNumb({
			decimals: 0
		}),
	});

	$montoRango.noUiSlider.on('update', function (values, handle) {
		$montoTexto.value = values[0];
	});
}
