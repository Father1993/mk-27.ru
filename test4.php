<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ТЕСТ ЧЕТЫРЕ");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.profile.list",
	"",
	Array(
		"PATH_TO_DETAIL" => "",
		"PER_PAGE" => "20",
		"SET_TITLE" => "Y"
	)
);?><br><?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>