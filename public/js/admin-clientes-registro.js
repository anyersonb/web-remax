var modal = new tingle.modal({
	footer: false,
	stickyFooter: false,
	closeMethods: ['overlay', 'button', 'escape'],
	closeLabel: "Cerrar",
	cssClass: ['terminos'],
	onOpen: function() {
		console.log('modal open');
	},
	onClose: function() {
		//console.log('modal closed');
	},
	beforeClose: function() {
		// here's goes some logic
		// e.g. save content before closing the modal
		return true; // close the modal
		return false; // nothing happens
	}
});

modal.setContent('<iframe src="http://remaxdesignperu.com/terminos?modal=true">');

document.getElementById('terminos')
	.addEventListener("click", evt => {
		modal.open();
		evt.preventDefault();
	});
