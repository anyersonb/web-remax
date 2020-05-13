if (typeof W == "undefined") {
	var W = window
}
if (typeof D == "undefined") {
	var D = document
}

D.addEventListener("DOMContentLoaded", evt => {
	const lightbox = GLightbox({
		touchNavigation: false,
		keyboardNavigation: false,
		loop: false,
		selector: "popup",
		hideControls: true,
		skin: "modern",
	});

	inicializarMenu()
});


function inicializarMenu(){
	D.getElementById("alternar-menu")
		.addEventListener("click", evt => {
			D.getElementById("menu")
				.classList.toggle("abierto")
			D.getElementById("alternar-menu")
				.classList.toggle("abierto")
		})
}
