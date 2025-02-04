function showVacancyList(id) {
	if ($(".category-list-" + id).is(":hidden")) {
		$(".category-list-" + id).show();
	} else {
		$(".category-list-" + id).hide();
	}
}
