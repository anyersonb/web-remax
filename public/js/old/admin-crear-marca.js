if (typeof W == "undefined") {
	var W = window
}
// const W = window
if (typeof D == "undefined") {
	var D = document
}

W.addEventListener("load", WLoad)

const $mostrar = D.getElementById("mostrar")

const $ordenadaTexto = D.querySelector("[name=ordenada]")
const $abscisaTexto = D.querySelector("[name=abscisa]")

const $tamagnoRango = D.getElementById("slider-tamagno")
const $tamagnoTexto = D.querySelector("[name=tamagno]")

const $imagen =  D.getElementById("imagen")
const $marca =  D.getElementById("marca")

function WLoad(evt) {
	$mostrar.addEventListener('change', function () {
		if (this.checked) {
			$tamagnoRango.removeAttribute('disabled' );
			$marca.classList.remove("oculto");
		} else {
			$tamagnoRango.setAttribute('disabled', true );
			$marca.classList.add("oculto");
		}
	});


	noUiSlider.create($tamagnoRango, {
		start: $tamagnoTexto.value,
		tooltips: wNumb({suffix: ' %', decimals: 0}),
		step: 1,
		range: {
			'min': 5,
			'max': 50
		},
		pips: {
			mode: "values",
			values: [5, 10, 15, 20, 30, 40, 50],
			density: 10
		},
		format: wNumb({
			decimals: 0
		}),
	});

	$tamagnoRango.noUiSlider.on('update', function (values, handle) {
		$tamagnoTexto.value = values[0];

		actualizarTamagno();
		actualizarPosicion();
	});

	Draggable.create($marca,{
		type: "top, left",
		bounds: $imagen,
		autoScroll: 1,
		onDrag: function(){
			//console.debug(this.endX, this.endY, this.pointerX, this.pointerY)
			vy = gsap.utils.pipe(
				gsap.utils.mapRange(this.minY, this.maxY, 0, 100),
				gsap.utils.snap(1),
				gsap.quickSetter($ordenadaTexto, "value"),
			);
			vy(this.endY);

			vx = gsap.utils.pipe(
				gsap.utils.mapRange(this.minX, this.maxX, 0, 100),
				gsap.utils.snap(1),
				gsap.quickSetter($abscisaTexto, "value"),
			);
			vx(this.endX);
			//console.log(vy(this.endY));
			//$ordenadaTexto.value = vy;
		}
	});

}

function actualizarPosicion(){
	var py = $ordenadaTexto.value / 100;
	var px = $abscisaTexto.value / 100;

	var anchoTotal = $imagen.clientWidth - $marca.clientWidth
	var altoTotal = $imagen.clientHeight - $marca.clientHeight

	$marca.style.top = Math.round( altoTotal * py )+"px";
	$marca.style.left = Math.round( anchoTotal * px )+"px";
}

function actualizarTamagno(){
	var t = $tamagnoTexto.value

	$marca.style.width = t + "%"
}
