if (typeof W == "undefined") {
	var W = window
}
if (typeof D == "undefined") {
	var D = document
}

AniJS.createAnimation([{
    event: 'click',
    eventTarget: 'footer',
    behaviorTarget: 'header',
    behavior: 'bounceIn',
    before: function(e, animationContext){
		if( someVariable ){
			//Run the animation
			animationContext.run()
		}
	}
}]);

D.addEventListener("DOMContentLoaded", evt => {
	const lightbox = GLightbox({
		touchNavigation: false,
		keyboardNavigation: false,
		selector: "popup"
	});
});
