var D = document
var W = window

W.addEventListener("load", evt => {
	inicializarScroll()
})


function inicializarScroll() {
	Scrollbar.init(D.querySelector("#beneficios_slider"), {
		alwaysShowTracks: true
	})
	Scrollbar.init(D.querySelector("#plantillas_slider"), {
		alwaysShowTracks: true
	})
}
