$(function(){
	$('.main-coming-slider').owlCarousel({
	    loop: true,
	    margin: 0,
	    nav: true,
		lazyLoad: true,
		smartSpeed: 150,
		//autoplay: true,
		responsive:{
	        0:{
	            items:2
	        },
	        576:{
	            items:3
	        },
	        991:{
	            items:4
	        }
	    }
	})	
})
