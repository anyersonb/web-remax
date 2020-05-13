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

	if (formulario.arte.value) {
		imagenUrl = formulario.arte.value
		cropper.replace(formulario.arte.value)
	}
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
			//cropper.destroy()
			//cropper = new Cropper(imagen, opcioonesCropper)
			cropper.replace(imagenUrl)
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
		alert("Debes elegir una imagen para tu anuncio")
		evt.preventDefault()
	}

	// $enlace = D.querySelector("[name=enlace]").value;
	// if (!urlValida($enlace)) {
	// 	alert("Debes ingresar una url válida para tu anuncio")
	// 	evt.preventDefault()
	// }

	// alert("submit")
	// previo.textContent = ""
	// previo.appendChild(recorte)
	// const ver = D.getElementById("ver")
	// ver.src = recorte.toDataURL()
}


function urlValida(cadena)
{
	patron = new RegExp('^(https?:\\/\\/)?'+ // protocol
		'((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
		'((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
		'(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
		'(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
		'(\\#[-a-z\\d_]*)?$','i');
	if (patron.test(cadena))
	{
		return true;
	}
	else
	{
		return false;
	}
}
