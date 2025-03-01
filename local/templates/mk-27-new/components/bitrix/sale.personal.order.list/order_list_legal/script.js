function showOrderDetail (id) {
	if ($("#" + id + " .order-details__list").css("display") == "none" || $("#" + id + " .order-details__list").css("visibility") == "hidden") {
		$("#" + id + " .order-details__list").slideDown();
		$("#" + id + " .arrow").addClass("active");	
		$("#" + id).addClass("active");	
	} else {
		$("#" + id + " .order-details__list").slideUp();
		$("#" + id + " .arrow").removeClass("active");
		$("#" + id).removeClass("active");
	}
	
}