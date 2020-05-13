var D = document
var W = window

W.addEventListener("load", evt => {
	inicializarSliders()
	inicializarScroll()
	inicializarFiltros()
	inicializarMenu()
})

var portada

function inicializarSliders() {
	portada = new Glide("#portada", {
		type: "carousel",
		startAt: 0,
		perView: 1,
		gap: 0,
		//autoplay: 4000,
		hoverpause: true
	}).mount()

	portada = new Glide("#instrucciones", {
		type: "carousel",
		startAt: 0,
		perView: 1,
		gap: 0,
		//autoplay: 4000,
		hoverpause: true
	}).mount()
	//console.log(portada)
}

function inicializarScroll() {
	let scroll = Scrollbar.init(D.querySelector("#beneficios_slider"), {
		alwaysShowTracks: true
	})
	//console.debug(scroll)
}

function inicializarFiltros() {
	const listaPMF = new Jets({
		contentTag: "#faq .faq_content",
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

	const filtros = D.querySelector("#faq .filtros");
	if(filtros!=null){
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
	}

}



// Function to reveal lightbox and adding YouTube autoplay
function revealVideo(video_code) {
  document.getElementById('youtube').src ="https://www.youtube.com/embed/"+video_code+"?showinfo=0&autoplay=1";
  document.getElementById('video').style.display = 'block';
}

// Hiding the lightbox and removing YouTube autoplay
function hideVideo() {
  var video = document.getElementById('youtube').src;
  var cleaned = video.replace('&autoplay=1',''); // removing autoplay form url
  document.getElementById('youtube').src = cleaned;
  document.getElementById('video').style.display = 'none';
  document.getElementById('youtube').src ="";
}


function inicializarMenu(){
	D.getElementById("alternar-menu")
		.addEventListener("click", evt => {
			D.getElementById("menu")
				.classList.toggle("abierto")
			D.getElementById("alternar-menu")
				.classList.toggle("abierto")
		})
}
