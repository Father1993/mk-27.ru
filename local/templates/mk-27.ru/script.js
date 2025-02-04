function showCityChange() {
	$(".header-city-change").fadeIn();
	$(".header-city-change .first-block").show();
	$(".header-city-change .second-block").hide();
}

function hideCityChange() {
	$(".header-city-change").fadeOut();
}
function showCitySelect() {
	$(".header-city-change .first-block").hide();
	$(".header-city-change .second-block").show();
}
function selectCity(city, restart) {
	BX.ajax({
		url: '/ajax/select_city.php',
		data: "city=" + city,
		method: 'POST',
		dataType: 'json',
		timeout: 30,
		async: true,
		processData: true,
		scriptsRunFirst: true,
		emulateOnload: true,
		start: true,
		cache: false,
		onsuccess: function(data){
			if (restart === true) {
				location.reload();
			} else {
				$(".header-city-change").fadeOut();
			}
		},
		onfailure: function(){
			
		}
	});
	return false;
}

/*
// Скрытие выбора города при клике вне этого блока.
jQuery(function($){
	$(document).mouseup( function(e){
		var div = $(".header-city-change");
		var p = $(".city-selected");
		var mobile = $(".city-icon");
		if (!div.is(e.target)
	    && div.has(e.target).length === 0 ) {
			if (!p.is(e.target)
		    && p.has(e.target).length === 0 ) {
				if (!mobile.is(e.target)
			    && mobile.has(e.target).length === 0 ) {
					div.fadeOut();
				}	
			}
		}https://metiz-komplekt27.ru/
	});
});
*/

function showMenu() {
	var windowWidth =  $(window).width();
	if (windowWidth >= 991) {
		if ($(".not-index-page .main-menu").is(":hidden")) {
			$(".not-index-page .main-menu").slideDown(250);
			$(".hamburger-icon").hide();
			$(".hamburger .cross").show();
		} else {
			$(".not-index-page .main-menu").slideUp(250);
			$(".hamburger-icon").show();
			$(".hamburger .cross").hide();
		}
	} else {
		if (!$(".main-menu-mobile-catalog").hasClass("active")) {
			$(".main-menu-mobile-catalog").addClass("active");
			$(".hamburger-icon").hide();
			$(".hamburger .cross").show();
		} else {
			$(".hamburger-icon").show();
			$(".hamburger .cross").hide();
			$(".main-menu-mobile-catalog").removeClass("active");
			$(".level-2-block").removeClass("active");
		}
	}
}

function cookiesAccept() {
	BX.ajax({
		url: '/ajax/cookies_accept.php',
		method: 'POST',
		dataType: 'json',
		timeout: 30,
		async: true,
		processData: true,
		scriptsRunFirst: true,
		emulateOnload: true,
		start: true,
		cache: false,
		onsuccess: function(data){
			$(".cookies_accept").fadeOut();
		},
		onfailure: function(){

		}
	});
	return false;
}

$(function(){
	$(".popup-window-overlay").click(function(){
		$(".popup-window-overlay").hide();
		$(".popup-window-with-titlebar").hide();
	});	
});
