/* не помню откуда это
$(function() {
	$(".main-catalog-menu > .parent > a.root-item").click(function() {
		if ($(window).width() < 992)
		{
			
			if ($(this).next().css('display') === "none")
			{
				$(this).parent().addClass("active");
				$(this).next().show();
				$(this).parent().next().css("border-top", "none");
			}
			else
			{
				$(this).parent().removeClass("active");
				$(this).next().hide();
				$(this).parent().next().css("border-top", "1px #f1f1f1 solid");
			}
			
			return false;
			
		}
	});
});
*/

$(function() {
	$(".not-index-page .main-catalog-menu li.parent").on({
	    mouseover: function() {
	        var top = $(this).offset().top - $(window).scrollTop();
			var height = $(this).children("ul.root-item").height();
			
			if ($(window).height() <= (height + top + 98)) {
				$(this).children(".root-item").css("bottom", 30);
				$(this).children(".root-item").css("top", "unset");
			} else {
				$(this).children(".root-item").css("top", top - 98);
				$(this).children(".root-item").css("bottom", "unset");
			}
			
			if (($(window).height() - 98) < height) { // Если высота блока больше, чем высота окна браузера минус 98 (фиксированная шапка)
				$(this).children(".root-item").css("columns", "3");
			}
	    }
	});
});