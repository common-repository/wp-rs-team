


jQuery(document).ready(function($){
	$('.owl-theme').owlCarousel({
		loop:true,
		margin:10,
		nav:true,
		items:4,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:3
			},
			1000:{
				items:4
			}
		}
	});	
});
