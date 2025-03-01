$(function(){
	$('.popular-in-section').owlCarousel({
	    loop: true,
	    margin: 0,
	    nav: true,
		lazyLoad: true,
		//autoplay: true,
		responsive:{
	        0:{
	            items:2
	        },
	        768:{
	            items:3
	        },
	        991:{
	            items:4
	        },
	        1200:{
	            items:5
	        }
	    }
	})	
});
