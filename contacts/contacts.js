function change_city(city) {
	$(".city-change").removeClass("active");
	$(".city-change-" + city).addClass("active");
	
	$(".contacts").removeClass("active");
	$(".contacts-" + city).addClass("active");
	
}
