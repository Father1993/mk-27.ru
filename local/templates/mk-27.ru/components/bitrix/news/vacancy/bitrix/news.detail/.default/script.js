function showVacancyPopup() {
	$(".grey-background").fadeIn();
	$(".vacancy-popup").fadeIn();
}
function hideVacancyPopup() {
	$(".grey-background").fadeOut();
	$(".vacancy-popup").fadeOut();
}
$(function(){
	$(".grey-background").click(function() {
		$(".grey-background").fadeOut();
		$(".vacancy-popup").fadeOut();
	});
	
	$(".vacancy-form").on("submit", function(event) {
		BX.ajax({
			url: '/ajax/send_vacancy_form.php',
			data: $(".vacancy-form").serialize(),
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
				$(".vacancy-form input[type='submit']").hide();
				$(".vacancy-popup .policy").hide();
				$(".vacancy-popup .success").show();
			},
			onfailure: function(){
				
			}
		});
		return false;
	});
	
	$(".antibot").removeAttr('required');
	$(".antibot").css("display", "none");
	
});

