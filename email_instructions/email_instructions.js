function changeEmailClient(client) {
	$(".switcher-button").removeClass("active");
	$(".switcher-button-" + client).addClass("active");
	
	$(".block").removeClass("active");
	$(".block-" + client).addClass("active");
	
}
