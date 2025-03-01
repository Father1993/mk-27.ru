$(function(){
	$('.catalog-products-viewed').owlCarousel({
	    loop: false,
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
