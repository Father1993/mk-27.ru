$(function(){
	
	$(".antibot").removeAttr("required");
	$(".antibot").css("display", "none");
	
	$(".pace-of-collection").change(function(){
		$(".email-to").val($("option[value='" + $(this).val() + "']").attr("email_address"));
	});
	
	let files; // переменная. будет содержать данные файлов
	
	$(".file-input").change(function() {
		if ($(this).val() != "") {
			$(this).prev().text("Выбрано файлов: " + $(this)[0].files.length);
		} else {
			$(this).prev().html("<span class='plus'>+</span>Прикрепить файлы");
		} 
		files = this.files;
	});
	
	$(document).on("submit", ".claims-and-appeals .form", function(){

		let data = new FormData($(".form-block .form")[0]);
		$.each( files, function( key, value ){
			data.append( key, value );
		});
		
	    $.ajax({
	        type: "POST",
	        url: "/ajax/claims_and_appeals.php",
	        data: data,
			cache: false,
			processData: false,
	        contentType: false,
			beforeSend: function(data){
	            $(".submit-button").val("Идёт загрузка...");
				$(".submit-button").css("background-color", "#666");
	        },
	        success: function(data){
				$(".submit-button").val("Отправлено");
				$(".submit-button").css("color", "green");
				$(".submit-button").css("background-color", "#fff");
				$(".submit-button").css("border-color", "#ccc");
				$(".submit-button").attr("disabled", true);
	            console.log(data);
	        }
	    });
		return false;
	});

});