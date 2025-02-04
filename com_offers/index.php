<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Транспортным компаниям");
?>

<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
	"PATH" => SITE_TEMPLATE_PATH . "/include/com_offers/text.php"
));?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
