<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Восстановление пароля");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.forgotpasswd",
	"my-forgot-pass",
	Array(
		"COMPONENT_TEMPLATE" => "my-forgot-pass"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>