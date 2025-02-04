<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказ детально");
?>
<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

/*
if ($arParams['SHOW_ORDER_PAGE'] !== 'Y')
{
	LocalRedirect($arParams['SEF_FOLDER']);
}
*/

if ($arParams["MAIN_CHAIN_NAME"] <> '')
{
	$APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}
$APPLICATION->AddChainItem(Loc::getMessage("SPS_CHAIN_ORDERS"), $arResult['PATH_TO_ORDERS']);
$APPLICATION->AddChainItem(Loc::getMessage("SPS_CHAIN_ORDER_DETAIL", array("#ID#" => urldecode($arResult["VARIABLES"]["ID"]))));

$arDetParams = array(
		"PATH_TO_LIST" => "/personal_section/index.php?SECTION=orders",
		"PATH_TO_CANCEL" => "",
		"PATH_TO_COPY" => "",
		"PATH_TO_PAYMENT" => "",
		"CACHE_TYPE" => "A",
		"ID" => $_GET["ID"],
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => "Y",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"PICTURE_WIDTH" => "110",
		"PICTURE_HEIGHT" => "110",
		"PICTURE_RESAMPLE_TYPE" => "1",
		"CUSTOM_SELECT_PROPS" => array(),
	);


$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.detail",
	"personal_order_detail",
	$arDetParams,
	$component
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>