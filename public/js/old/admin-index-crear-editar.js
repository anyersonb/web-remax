if (typeof W == "undefined") {
	var W = window
}
// const W = window
if (typeof D == "undefined") {
	var D = document
}

const URL = W.URL || W.webkitURL
W.addEventListener("load", WLoad)

const imagen = D.getElementById("imagen")
const selector = D.getElementById("selectorImagen")
const formulario = D.forms[0]

const opcioonesCropper = {
	viewMode: 2,
	dragMode: "move",
	aspectRatio: 1,
	responsive: true,
	checkOrientation: true,
	autoCropArea: 1,
	autoCrop: true,
	//preview: ".previo",
	ready: function(e) {
		//- console.log(e.type)
	},
	cropend: function(e) {
		//- console.log(e.type, e.detail.action)
	},
	crop: function(e) {
		// console.log(e.type, e.detail)
		// const previo = D.getElementsByClassName("previo")[0]
		// const recorte = cropper.getCroppedCanvas({ width: 1080, height: 1080 })
		// previo.textContent = ""
		// previo.appendChild(recorte)
		// const ver = D.getElementById("ver")
		// ver.src = recorte.toDataURL()
	}
}
let cropper
let imagenUrl
let arte = false


function WLoad(evt) {
	cropper = new Cropper(imagen, opcioonesCropper)

	//console.debug(cropper)
	selector.addEventListener("change", selectorChange)

	formulario.addEventListener("submit", formularioSubmit)
}

function selectorChange(evt) {
	//console.log(evt)
	const input = evt.target
	if (input.files.length) {
		// console.debug(archivos[0])
		const archivo = input.files[0]
		if (/^image\/\w+/.test(archivo.type)) {
			uploadedImageType = archivo.type
			uploadedImageName = archivo.name
			console.debug(archivo);

			if (imagenUrl) {
				URL.revokeObjectURL(imagenUrl)
			}

			imagen.src = imagenUrl = URL.createObjectURL(archivo)
			cropper.destroy()
			cropper = new Cropper(imagen, opcioonesCropper)
			selector.value = null
		} else {
			W.alert("por favor elige una imagen.")
		}
	}
}

function formularioSubmit(evt) {
	if (imagenUrl) {
		const recorte = cropper.getCroppedCanvas({ width: 1080, height: 1080 })
		formulario.arte.value = recorte.toDataURL("image/png")
	} else {
		alert("debes elegir una imagen para tu anuncio")
		evt.preventDefault()
	}
	// alert("submit")
	// previo.textContent = ""
	// previo.appendChild(recorte)
	// const ver = D.getElementById("ver")
	// ver.src = recorte.toDataURL()
}
