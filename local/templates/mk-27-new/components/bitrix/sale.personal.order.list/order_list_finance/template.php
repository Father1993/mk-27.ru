<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

/** @var CBitrixPersonalOrderListComponent $component */
/** @var array $arParams */
/** @var array $arResult */

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

\Bitrix\Main\UI\Extension::load([
	'ui.design-tokens',
	'ui.fonts.opensans',
	'clipboard',
	'fx',
]);

Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");
Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/style.css");
$this->addExternalCss("/bitrix/css/main/bootstrap.css");

Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}

}
else
{
	$filterHistory = ($_REQUEST['filter_history'] ?? '');
	$filterShowCanceled = ($_REQUEST["show_canceled"] ?? '');

	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	if (empty($arResult['ORDERS']))
	{
		if ($filterHistory === 'Y')
		{
			if ($filterShowCanceled === 'Y')
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?></h3>
				<?
			}
			else
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?></h3>
				<?
			}
		}
		/*
		else
		{
			?>
			<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></h3>
			<?
		} */
	}
	?>
    <div class="container personal">
    	<div class="row">

    <div class="col-12 col-lg-3 personal-left">

        <div class="personal-menu">
            <?php $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . "/components/bitrix/sale.personal.section/personal_section_legal/personal_menu.php",
                Array(),
                Array("MODE"=>"PHP")); ?>
        </div>

    </div>

    <div class="col-lg-9 col-md-12 col-sm-12">

        <h1>Документы</h1>
    <div class="row col-md-12 col-sm-12 general-documents">
        <div class="row col-md-4 col-sm-12 col-lg-3">
            <a href="/docs/АктСверкиВзаиморасчетов.pdf" class="download-docs" target="_blank">
                <!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 48 48" height="48px" id="_x3C_Layer_x3E_" version="1.1" viewBox="0 0 48 48" width="48px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="document_x2C__file"><path d="M41,45.5H12c-0.276,0-0.5-0.224-0.5-0.5V14.5l8-8H41c0.276,0,0.5,0.224,0.5,0.5v38   C41.5,45.276,41.276,45.5,41,45.5z" fill="#E1F5FE"/><path d="M41,45H12v-1.586c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5V44h27V8h-1.586c-0.276,0-0.5-0.224-0.5-0.5   s0.224-0.5,0.5-0.5H41V45z" fill="#FFFFFF"/><path d="M41,46H12c-0.551,0-1-0.449-1-1v-1.5c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5V45h29V7h-2.5   C38.223,7,38,6.776,38,6.5S38.223,6,38.5,6H41c0.551,0,1,0.449,1,1v38C42,45.551,41.551,46,41,46z" fill="#0277BD"/><path d="M36,41.5H7c-0.276,0-0.5-0.224-0.5-0.5V10.5l8-8H36c0.276,0,0.5,0.224,0.5,0.5v38   C36.5,41.276,36.276,41.5,36,41.5z" fill="#E1F5FE"/><path d="M36,41H7V10.707L14.707,3H36V41z M8,40h27V4H15.121L8,11.121V40z" fill="#FFFFFF"/><path d="M36,42H7c-0.551,0-1-0.449-1-1V10.293L14.292,2H36c0.551,0,1,0.449,1,1v38C37,41.551,36.551,42,36,42z    M36,41v0.5V41L36,41z M7,10.707V41h29V3H14.707L7,10.707z" fill="#0277BD"/><path d="M14,10.5H6.5l8-8V10C14.5,10.276,14.276,10.5,14,10.5z" fill="#FFE57F"/><path d="M9.426,9.488c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l3.573-3.573   c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L9.779,9.342C9.682,9.439,9.554,9.488,9.426,9.488z" fill="#FFFFFF"/><path d="M14,11H6.5c-0.202,0-0.385-0.122-0.462-0.309c-0.078-0.187-0.035-0.402,0.108-0.545l8-8   c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L7.707,10H14V5.5C14,5.224,14.224,5,14.5,5S15,5.224,15,5.5V10   C15,10.551,14.551,11,14,11z" fill="#0277BD"/><g><path d="M30.5,27h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,27,30.5,27z" fill="#0277BD"/><path d="M30.5,24h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,24,30.5,24z" fill="#0277BD"/><path d="M30.5,21h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,21,30.5,21z" fill="#0277BD"/><path d="M25.5,30h-13c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h13c0.276,0,0.5,0.224,0.5,0.5    S25.776,30,25.5,30z" fill="#0277BD"/><path d="M25.5,15h-8c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h8c0.276,0,0.5,0.224,0.5,0.5S25.776,15,25.5,15    z" fill="#0277BD"/><path d="M30.5,18h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,18,30.5,18z" fill="#0277BD"/></g></g></svg>
                <span>Акт сверки взаиморасчетов</span>
            </a>
        </div>
        <div class="row col-md-4 col-sm-12 col-lg-3">
            <a href="/docs/ДоговорПоставки.xlsx" class="download-docs" target="_blank">
                <!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 48 48" height="48px" id="_x3C_Layer_x3E_" version="1.1" viewBox="0 0 48 48" width="48px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="document_x2C__file"><path d="M41,45.5H12c-0.276,0-0.5-0.224-0.5-0.5V14.5l8-8H41c0.276,0,0.5,0.224,0.5,0.5v38   C41.5,45.276,41.276,45.5,41,45.5z" fill="#E1F5FE"/><path d="M41,45H12v-1.586c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5V44h27V8h-1.586c-0.276,0-0.5-0.224-0.5-0.5   s0.224-0.5,0.5-0.5H41V45z" fill="#FFFFFF"/><path d="M41,46H12c-0.551,0-1-0.449-1-1v-1.5c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5V45h29V7h-2.5   C38.223,7,38,6.776,38,6.5S38.223,6,38.5,6H41c0.551,0,1,0.449,1,1v38C42,45.551,41.551,46,41,46z" fill="#0277BD"/><path d="M36,41.5H7c-0.276,0-0.5-0.224-0.5-0.5V10.5l8-8H36c0.276,0,0.5,0.224,0.5,0.5v38   C36.5,41.276,36.276,41.5,36,41.5z" fill="#E1F5FE"/><path d="M36,41H7V10.707L14.707,3H36V41z M8,40h27V4H15.121L8,11.121V40z" fill="#FFFFFF"/><path d="M36,42H7c-0.551,0-1-0.449-1-1V10.293L14.292,2H36c0.551,0,1,0.449,1,1v38C37,41.551,36.551,42,36,42z    M36,41v0.5V41L36,41z M7,10.707V41h29V3H14.707L7,10.707z" fill="#0277BD"/><path d="M14,10.5H6.5l8-8V10C14.5,10.276,14.276,10.5,14,10.5z" fill="#FFE57F"/><path d="M9.426,9.488c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l3.573-3.573   c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L9.779,9.342C9.682,9.439,9.554,9.488,9.426,9.488z" fill="#FFFFFF"/><path d="M14,11H6.5c-0.202,0-0.385-0.122-0.462-0.309c-0.078-0.187-0.035-0.402,0.108-0.545l8-8   c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L7.707,10H14V5.5C14,5.224,14.224,5,14.5,5S15,5.224,15,5.5V10   C15,10.551,14.551,11,14,11z" fill="#0277BD"/><g><path d="M30.5,27h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,27,30.5,27z" fill="#0277BD"/><path d="M30.5,24h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,24,30.5,24z" fill="#0277BD"/><path d="M30.5,21h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,21,30.5,21z" fill="#0277BD"/><path d="M25.5,30h-13c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h13c0.276,0,0.5,0.224,0.5,0.5    S25.776,30,25.5,30z" fill="#0277BD"/><path d="M25.5,15h-8c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h8c0.276,0,0.5,0.224,0.5,0.5S25.776,15,25.5,15    z" fill="#0277BD"/><path d="M30.5,18h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,18,30.5,18z" fill="#0277BD"/></g></g></svg>
                <span>Договор поставки</span>
            </a>
        </div>
        <div class="row col-md-4 col-sm-12 col-lg-3">
            <a href="/docs/ДоверительноеПисьмо.pdf" class="download-docs" target="_blank">
                <!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 48 48" height="48px" id="_x3C_Layer_x3E_" version="1.1" viewBox="0 0 48 48" width="48px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="document_x2C__file"><path d="M41,45.5H12c-0.276,0-0.5-0.224-0.5-0.5V14.5l8-8H41c0.276,0,0.5,0.224,0.5,0.5v38   C41.5,45.276,41.276,45.5,41,45.5z" fill="#E1F5FE"/><path d="M41,45H12v-1.586c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5V44h27V8h-1.586c-0.276,0-0.5-0.224-0.5-0.5   s0.224-0.5,0.5-0.5H41V45z" fill="#FFFFFF"/><path d="M41,46H12c-0.551,0-1-0.449-1-1v-1.5c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5V45h29V7h-2.5   C38.223,7,38,6.776,38,6.5S38.223,6,38.5,6H41c0.551,0,1,0.449,1,1v38C42,45.551,41.551,46,41,46z" fill="#0277BD"/><path d="M36,41.5H7c-0.276,0-0.5-0.224-0.5-0.5V10.5l8-8H36c0.276,0,0.5,0.224,0.5,0.5v38   C36.5,41.276,36.276,41.5,36,41.5z" fill="#E1F5FE"/><path d="M36,41H7V10.707L14.707,3H36V41z M8,40h27V4H15.121L8,11.121V40z" fill="#FFFFFF"/><path d="M36,42H7c-0.551,0-1-0.449-1-1V10.293L14.292,2H36c0.551,0,1,0.449,1,1v38C37,41.551,36.551,42,36,42z    M36,41v0.5V41L36,41z M7,10.707V41h29V3H14.707L7,10.707z" fill="#0277BD"/><path d="M14,10.5H6.5l8-8V10C14.5,10.276,14.276,10.5,14,10.5z" fill="#FFE57F"/><path d="M9.426,9.488c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l3.573-3.573   c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L9.779,9.342C9.682,9.439,9.554,9.488,9.426,9.488z" fill="#FFFFFF"/><path d="M14,11H6.5c-0.202,0-0.385-0.122-0.462-0.309c-0.078-0.187-0.035-0.402,0.108-0.545l8-8   c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L7.707,10H14V5.5C14,5.224,14.224,5,14.5,5S15,5.224,15,5.5V10   C15,10.551,14.551,11,14,11z" fill="#0277BD"/><g><path d="M30.5,27h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,27,30.5,27z" fill="#0277BD"/><path d="M30.5,24h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,24,30.5,24z" fill="#0277BD"/><path d="M30.5,21h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,21,30.5,21z" fill="#0277BD"/><path d="M25.5,30h-13c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h13c0.276,0,0.5,0.224,0.5,0.5    S25.776,30,25.5,30z" fill="#0277BD"/><path d="M25.5,15h-8c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h8c0.276,0,0.5,0.224,0.5,0.5S25.776,15,25.5,15    z" fill="#0277BD"/><path d="M30.5,18h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,18,30.5,18z" fill="#0277BD"/></g></g></svg>
                <span>Доверительное письмо</span>
            </a>
        </div>
        <div class="row col-md-4 col-sm-12 col-lg-3">
            <a href="/docs/ШаблонСпецификаций.xlsx" class="download-docs" target="_blank">
                <!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 48 48" height="48px" id="_x3C_Layer_x3E_" version="1.1" viewBox="0 0 48 48" width="48px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="document_x2C__file"><path d="M41,45.5H12c-0.276,0-0.5-0.224-0.5-0.5V14.5l8-8H41c0.276,0,0.5,0.224,0.5,0.5v38   C41.5,45.276,41.276,45.5,41,45.5z" fill="#E1F5FE"/><path d="M41,45H12v-1.586c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5V44h27V8h-1.586c-0.276,0-0.5-0.224-0.5-0.5   s0.224-0.5,0.5-0.5H41V45z" fill="#FFFFFF"/><path d="M41,46H12c-0.551,0-1-0.449-1-1v-1.5c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5V45h29V7h-2.5   C38.223,7,38,6.776,38,6.5S38.223,6,38.5,6H41c0.551,0,1,0.449,1,1v38C42,45.551,41.551,46,41,46z" fill="#0277BD"/><path d="M36,41.5H7c-0.276,0-0.5-0.224-0.5-0.5V10.5l8-8H36c0.276,0,0.5,0.224,0.5,0.5v38   C36.5,41.276,36.276,41.5,36,41.5z" fill="#E1F5FE"/><path d="M36,41H7V10.707L14.707,3H36V41z M8,40h27V4H15.121L8,11.121V40z" fill="#FFFFFF"/><path d="M36,42H7c-0.551,0-1-0.449-1-1V10.293L14.292,2H36c0.551,0,1,0.449,1,1v38C37,41.551,36.551,42,36,42z    M36,41v0.5V41L36,41z M7,10.707V41h29V3H14.707L7,10.707z" fill="#0277BD"/><path d="M14,10.5H6.5l8-8V10C14.5,10.276,14.276,10.5,14,10.5z" fill="#FFE57F"/><path d="M9.426,9.488c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l3.573-3.573   c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L9.779,9.342C9.682,9.439,9.554,9.488,9.426,9.488z" fill="#FFFFFF"/><path d="M14,11H6.5c-0.202,0-0.385-0.122-0.462-0.309c-0.078-0.187-0.035-0.402,0.108-0.545l8-8   c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L7.707,10H14V5.5C14,5.224,14.224,5,14.5,5S15,5.224,15,5.5V10   C15,10.551,14.551,11,14,11z" fill="#0277BD"/><g><path d="M30.5,27h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,27,30.5,27z" fill="#0277BD"/><path d="M30.5,24h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,24,30.5,24z" fill="#0277BD"/><path d="M30.5,21h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,21,30.5,21z" fill="#0277BD"/><path d="M25.5,30h-13c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h13c0.276,0,0.5,0.224,0.5,0.5    S25.776,30,25.5,30z" fill="#0277BD"/><path d="M25.5,15h-8c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h8c0.276,0,0.5,0.224,0.5,0.5S25.776,15,25.5,15    z" fill="#0277BD"/><path d="M30.5,18h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,18,30.5,18z" fill="#0277BD"/></g></g></svg>
                <span>Шаблон спецификаций</span>
            </a>
        </div>
        <div class="row col-md-4 col-sm-12 col-lg-3">
            <a href="/docs/Акт расхождений.docx" class="download-docs" target="_blank">
                <!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 48 48" height="48px" id="_x3C_Layer_x3E_" version="1.1" viewBox="0 0 48 48" width="48px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="document_x2C__file"><path d="M41,45.5H12c-0.276,0-0.5-0.224-0.5-0.5V14.5l8-8H41c0.276,0,0.5,0.224,0.5,0.5v38   C41.5,45.276,41.276,45.5,41,45.5z" fill="#E1F5FE"/><path d="M41,45H12v-1.586c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5V44h27V8h-1.586c-0.276,0-0.5-0.224-0.5-0.5   s0.224-0.5,0.5-0.5H41V45z" fill="#FFFFFF"/><path d="M41,46H12c-0.551,0-1-0.449-1-1v-1.5c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5V45h29V7h-2.5   C38.223,7,38,6.776,38,6.5S38.223,6,38.5,6H41c0.551,0,1,0.449,1,1v38C42,45.551,41.551,46,41,46z" fill="#0277BD"/><path d="M36,41.5H7c-0.276,0-0.5-0.224-0.5-0.5V10.5l8-8H36c0.276,0,0.5,0.224,0.5,0.5v38   C36.5,41.276,36.276,41.5,36,41.5z" fill="#E1F5FE"/><path d="M36,41H7V10.707L14.707,3H36V41z M8,40h27V4H15.121L8,11.121V40z" fill="#FFFFFF"/><path d="M36,42H7c-0.551,0-1-0.449-1-1V10.293L14.292,2H36c0.551,0,1,0.449,1,1v38C37,41.551,36.551,42,36,42z    M36,41v0.5V41L36,41z M7,10.707V41h29V3H14.707L7,10.707z" fill="#0277BD"/><path d="M14,10.5H6.5l8-8V10C14.5,10.276,14.276,10.5,14,10.5z" fill="#FFE57F"/><path d="M9.426,9.488c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l3.573-3.573   c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L9.779,9.342C9.682,9.439,9.554,9.488,9.426,9.488z" fill="#FFFFFF"/><path d="M14,11H6.5c-0.202,0-0.385-0.122-0.462-0.309c-0.078-0.187-0.035-0.402,0.108-0.545l8-8   c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L7.707,10H14V5.5C14,5.224,14.224,5,14.5,5S15,5.224,15,5.5V10   C15,10.551,14.551,11,14,11z" fill="#0277BD"/><g><path d="M30.5,27h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,27,30.5,27z" fill="#0277BD"/><path d="M30.5,24h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,24,30.5,24z" fill="#0277BD"/><path d="M30.5,21h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,21,30.5,21z" fill="#0277BD"/><path d="M25.5,30h-13c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h13c0.276,0,0.5,0.224,0.5,0.5    S25.776,30,25.5,30z" fill="#0277BD"/><path d="M25.5,15h-8c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h8c0.276,0,0.5,0.224,0.5,0.5S25.776,15,25.5,15    z" fill="#0277BD"/><path d="M30.5,18h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,18,30.5,18z" fill="#0277BD"/></g></g></svg>
                <span>Акт расхождений</span>
            </a>
        </div>
        <div class="row col-md-4 col-sm-12 col-lg-3">
            <a href="/docs/Возврат.docx" class="download-docs" target="_blank">
                <!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 48 48" height="48px" id="_x3C_Layer_x3E_" version="1.1" viewBox="0 0 48 48" width="48px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="document_x2C__file"><path d="M41,45.5H12c-0.276,0-0.5-0.224-0.5-0.5V14.5l8-8H41c0.276,0,0.5,0.224,0.5,0.5v38   C41.5,45.276,41.276,45.5,41,45.5z" fill="#E1F5FE"/><path d="M41,45H12v-1.586c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5V44h27V8h-1.586c-0.276,0-0.5-0.224-0.5-0.5   s0.224-0.5,0.5-0.5H41V45z" fill="#FFFFFF"/><path d="M41,46H12c-0.551,0-1-0.449-1-1v-1.5c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5V45h29V7h-2.5   C38.223,7,38,6.776,38,6.5S38.223,6,38.5,6H41c0.551,0,1,0.449,1,1v38C42,45.551,41.551,46,41,46z" fill="#0277BD"/><path d="M36,41.5H7c-0.276,0-0.5-0.224-0.5-0.5V10.5l8-8H36c0.276,0,0.5,0.224,0.5,0.5v38   C36.5,41.276,36.276,41.5,36,41.5z" fill="#E1F5FE"/><path d="M36,41H7V10.707L14.707,3H36V41z M8,40h27V4H15.121L8,11.121V40z" fill="#FFFFFF"/><path d="M36,42H7c-0.551,0-1-0.449-1-1V10.293L14.292,2H36c0.551,0,1,0.449,1,1v38C37,41.551,36.551,42,36,42z    M36,41v0.5V41L36,41z M7,10.707V41h29V3H14.707L7,10.707z" fill="#0277BD"/><path d="M14,10.5H6.5l8-8V10C14.5,10.276,14.276,10.5,14,10.5z" fill="#FFE57F"/><path d="M9.426,9.488c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l3.573-3.573   c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L9.779,9.342C9.682,9.439,9.554,9.488,9.426,9.488z" fill="#FFFFFF"/><path d="M14,11H6.5c-0.202,0-0.385-0.122-0.462-0.309c-0.078-0.187-0.035-0.402,0.108-0.545l8-8   c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L7.707,10H14V5.5C14,5.224,14.224,5,14.5,5S15,5.224,15,5.5V10   C15,10.551,14.551,11,14,11z" fill="#0277BD"/><g><path d="M30.5,27h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,27,30.5,27z" fill="#0277BD"/><path d="M30.5,24h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,24,30.5,24z" fill="#0277BD"/><path d="M30.5,21h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,21,30.5,21z" fill="#0277BD"/><path d="M25.5,30h-13c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h13c0.276,0,0.5,0.224,0.5,0.5    S25.776,30,25.5,30z" fill="#0277BD"/><path d="M25.5,15h-8c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h8c0.276,0,0.5,0.224,0.5,0.5S25.776,15,25.5,15    z" fill="#0277BD"/><path d="M30.5,18h-18c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h18c0.276,0,0.5,0.224,0.5,0.5    S30.776,18,30.5,18z" fill="#0277BD"/></g></g></svg>
                <span>Возврат</span>
            </a>
        </div>
        <?
		$nothing = !isset($_REQUEST["filter_history"]) && !isset($_REQUEST["show_all"]);
		$clearFromLink = array("filter_history","filter_status","show_all", "show_canceled");
		?>
	</div>
	<?
	if (empty($arResult['ORDERS']))
	{
		?>
        <div class="row col-md-12 col-sm-12 empty-order">
            <div class="empty-order-caption">У вас ещё нет заказов.</div>
            <a href="<?=htmlspecialcharsbx($arParams['PATH_TO_CATALOG'])?>" class="sale-order-history-link">
                <?=Loc::getMessage('SPOL_TPL_LINK_TO_CATALOG')?>
            </a>
            <a href="/personal/cart/">Перейти в корзину</a>
        </div>
		<?
	}

	if ($filterHistory !== 'Y')
	{
		$paymentChangeData = array();
		$orderHeaderStatus = null;

		foreach ($arResult['ORDERS'] as $key => $order)
		{
			if ($orderHeaderStatus !== $order['ORDER']['STATUS_ID'] && $arResult['SORT_TYPE'] == 'STATUS')
			{
				$orderHeaderStatus = $order['ORDER']['STATUS_ID'];

				?>
				<h1 class="sale-order-title">
					Документы по заказам
				</h1>
				<?
			}
			?>
			<div class="col-md-12 col-sm-12 sale-order-list-container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 sale-order-list-title-container">
						<h2 class="sale-order-list-title">
							<?=Loc::getMessage('SPOL_TPL_ORDER')?>
							<?=Loc::getMessage('SPOL_TPL_NUMBER_SIGN').$order['ORDER']['ACCOUNT_NUMBER']?>
							<?=Loc::getMessage('SPOL_TPL_FROM_DATE')?>
							<?=$order['ORDER']['DATE_INSERT_FORMATED']?>,
							<?=count($order['BASKET_ITEMS']);?>
							<?
							$count = count($order['BASKET_ITEMS']) % 10;
							if ($count == '1')
							{
								echo Loc::getMessage('SPOL_TPL_GOOD');
							}
							elseif ($count >= '2' && $count <= '4')
							{
								echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
							}
							else
							{
								echo Loc::getMessage('SPOL_TPL_GOODS');
							}
							?>
							<?=Loc::getMessage('SPOL_TPL_SUMOF')?>
							<?=$order['ORDER']['FORMATED_PRICE']?>
						</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 sale-order-list-inner-container">
						<span class="sale-order-list-inner-title-line">
							<span class="sale-order-list-inner-title-line-item"><?=Loc::getMessage('SPOL_TPL_PAYMENT')?></span>
							<span class="sale-order-list-inner-title-line-border"></span>
						</span>
						<?
						$showDelimeter = false;
						foreach ($order['PAYMENT'] as $payment)
						{
							if ($order['ORDER']['LOCK_CHANGE_PAYSYSTEM'] !== 'Y')
							{
								$paymentChangeData[$payment['ACCOUNT_NUMBER']] = array(
									"order" => htmlspecialcharsbx($order['ORDER']['ACCOUNT_NUMBER']),
									"payment" => htmlspecialcharsbx($payment['ACCOUNT_NUMBER']),
									"allow_inner" => $arParams['ALLOW_INNER'],
									"refresh_prices" => $arParams['REFRESH_PRICES'],
									"path_to_payment" => $arParams['PATH_TO_PAYMENT'],
									"only_inner_full" => $arParams['ONLY_INNER_FULL'],
									"return_url" => $arResult['RETURN_URL'],
								);
							}
							?>
							<div class="row sale-order-list-inner-row">
								<?
								if ($showDelimeter)
								{
									?>
									<div class="sale-order-list-top-border"></div>
									<?
								}
								else
								{
									$showDelimeter = true;
								}
								?>
								<div class="sale-order-list-inner-row-body">
									<div class="col-md-9 col-sm-8 col-xs-12 sale-order-list-payment">
										<div class="sale-order-list-payment-title">
											<?
											$paymentSubTitle = Loc::getMessage('SPOL_TPL_BILL')." ".Loc::getMessage('SPOL_TPL_NUMBER_SIGN').htmlspecialcharsbx($payment['ACCOUNT_NUMBER']);
											if(isset($payment['DATE_BILL']))
											{
												$paymentSubTitle .= " ".Loc::getMessage('SPOL_TPL_FROM_DATE')." ".$payment['DATE_BILL_FORMATED'];
											}
											$paymentSubTitle .=",";
											echo $paymentSubTitle;
											?>
											<span class="sale-order-list-payment-title-element"><?=$payment['PAY_SYSTEM_NAME']?></span>
											<?
											if ($payment['PAID'] === 'Y')
											{
												?>
												<span class="sale-order-list-status-success"><?=Loc::getMessage('SPOL_TPL_PAID')?></span>
												<?
											}
											elseif ($order['ORDER']['IS_ALLOW_PAY'] == 'N')
											{
												?>
												<span class="sale-order-list-status-restricted"><?=Loc::getMessage('SPOL_TPL_RESTRICTED_PAID')?></span>
												<?
											}
											else
											{
												?>
												<span class="sale-order-list-status-alert"><?=Loc::getMessage('SPOL_TPL_NOTPAID')?></span>
												<?
											}
											?>
										</div>
										<div class="sale-order-list-payment-price">
											<span class="sale-order-list-payment-element"><?=Loc::getMessage('SPOL_TPL_SUM_TO_PAID')?>:</span>

											<span class="sale-order-list-payment-number"><?=$payment['FORMATED_SUM']?></span>
										</div>
										<?
										if (!empty($payment['CHECK_DATA']))
										{
											$listCheckLinks = "";
											foreach ($payment['CHECK_DATA'] as $checkInfo)
											{
												$title = Loc::getMessage('SPOL_CHECK_NUM', array('#CHECK_NUMBER#' => $checkInfo['ID']))." - ". htmlspecialcharsbx($checkInfo['TYPE_NAME']);
												if($checkInfo['LINK'] <> '')
												{
													$link = $checkInfo['LINK'];
													$listCheckLinks .= "<div><a href='$link' target='_blank'>$title</a></div>";
												}
											}
											if ($listCheckLinks <> '')
											{
												?>
												<div class="sale-order-list-payment-check">
													<div class="sale-order-list-payment-check-left"><?= Loc::getMessage('SPOL_CHECK_TITLE')?>:</div>
													<div class="sale-order-list-payment-check-left">
														<?=$listCheckLinks?>
													</div>
												</div>
												<?
											}
										}
										if ($payment['PAID'] !== 'Y' && $order['ORDER']['LOCK_CHANGE_PAYSYSTEM'] !== 'Y')
										{
											?>
											<a href="#" class="sale-order-list-change-payment" id="<?= htmlspecialcharsbx($payment['ACCOUNT_NUMBER']) ?>">
												<?= Loc::getMessage('SPOL_TPL_CHANGE_PAY_TYPE') ?>
											</a>
											<?
										}
										if ($order['ORDER']['IS_ALLOW_PAY'] == 'N' && $payment['PAID'] !== 'Y')
										{
											?>
											<div class="sale-order-list-status-restricted-message-block">
												<span class="sale-order-list-status-restricted-message"><?=Loc::getMessage('SOPL_TPL_RESTRICTED_PAID_MESSAGE')?></span>
											</div>
											<?
										}
										?>

									</div>
									<?
									if ($payment['PAID'] === 'N' && $payment['IS_CASH'] !== 'Y' && $payment['ACTION_FILE'] !== 'cash')
									{
										if ($order['ORDER']['IS_ALLOW_PAY'] == 'N')
										{
											?>
											<div class="col-md-3 col-sm-4 col-xs-12 sale-order-list-button-container">
												<a class="sale-order-list-button inactive-button">
													<?=Loc::getMessage('SPOL_TPL_PAY')?>
												</a>
											</div>
											<?
										}
										elseif ($payment['NEW_WINDOW'] === 'Y')
										{
											?>
											<div class="col-md-3 col-sm-4 col-xs-12 sale-order-list-button-container">
												<a class="sale-order-list-button" target="_blank" href="<?=htmlspecialcharsbx($payment['PSA_ACTION_FILE'])?>">
													<?=Loc::getMessage('SPOL_TPL_PAY')?>
												</a>
											</div>
											<?
										}
										else
										{
											?>
											<div class="col-md-3 col-sm-4 col-xs-12 sale-order-list-button-container">
												<a class="sale-order-list-button ajax_reload" href="<?=htmlspecialcharsbx($payment['PSA_ACTION_FILE'])?>">
													<?=Loc::getMessage('SPOL_TPL_PAY')?>
												</a>
											</div>
											<?
										}
									}
									?>

								</div>
								<div class="col-lg-9 col-md-9 col-sm-10 col-xs-12 sale-order-list-inner-row-template">
									<a class="sale-order-list-cancel-payment">
										<i class="fa fa-long-arrow-left"></i> <?=Loc::getMessage('SPOL_CANCEL_PAYMENT')?>
									</a>
								</div>
							</div>
							<?
						}
						if (!empty($order['SHIPMENT']))
						{
							?>
							<div class="sale-order-list-inner-title-line">
								<span class="sale-order-list-inner-title-line-item"><?=Loc::getMessage('SPOL_TPL_DELIVERY')?></span>
								<span class="sale-order-list-inner-title-line-border"></span>
							</div>
							<?
						}
						$showDelimeter = false;
						foreach ($order['SHIPMENT'] as $shipment)
						{
							if (empty($shipment))
							{
								continue;
							}
							?>
							<div class="row sale-order-list-inner-row">
								<?
                                /*
									if ($showDelimeter)
									{
										?>
										<div class="sale-order-list-top-border"></div>
										<?
									}
									else
									{
										$showDelimeter = true;
									}
                                */
								?>
								<div class="col-md-9 col-sm-8 col-xs-12 sale-order-list-shipment">
									<div class="sale-order-list-shipment-title">
									<span class="sale-order-list-shipment-element">
										<?=Loc::getMessage('SPOL_TPL_LOAD')?>
										<?
										$shipmentSubTitle = Loc::getMessage('SPOL_TPL_NUMBER_SIGN').htmlspecialcharsbx($shipment['ACCOUNT_NUMBER']);
										if ($shipment['DATE_DEDUCTED'])
										{
											$shipmentSubTitle .= " ".Loc::getMessage('SPOL_TPL_FROM_DATE')." ".$shipment['DATE_DEDUCTED_FORMATED'];
										}

										if ($shipment['FORMATED_DELIVERY_PRICE'])
										{
											$shipmentSubTitle .= ", ".Loc::getMessage('SPOL_TPL_DELIVERY_COST')." ".$shipment['FORMATED_DELIVERY_PRICE'];
										}
										echo $shipmentSubTitle;
										?>
									</span>
										<?
										if ($shipment['DEDUCTED'] == 'Y')
										{
											?>
											<span class="sale-order-list-status-success"><?=Loc::getMessage('SPOL_TPL_LOADED');?></span>
											<?
										}
										else
										{
											?>
											<span class="sale-order-list-status-alert"><?=Loc::getMessage('SPOL_TPL_NOTLOADED');?></span>
											<?
										}
										?>
									</div>

									<div class="sale-order-list-shipment-status">
										<span class="sale-order-list-shipment-status-item"><?=Loc::getMessage('SPOL_ORDER_SHIPMENT_STATUS');?>:</span>
										<span class="sale-order-list-shipment-status-block"><?=htmlspecialcharsbx($shipment['DELIVERY_STATUS_NAME'])?></span>
									</div>

									<?
									if (!empty($shipment['DELIVERY_ID']))
									{
										?>
										<div class="sale-order-list-shipment-item">
											<?=Loc::getMessage('SPOL_TPL_DELIVERY_SERVICE')?>:
											<?=$arResult['INFO']['DELIVERY'][$shipment['DELIVERY_ID']]['NAME']?>
										</div>
										<?
									}

									if (!empty($shipment['TRACKING_NUMBER']))
									{
										?>
										<div class="sale-order-list-shipment-item">
											<span class="sale-order-list-shipment-id-name"><?=Loc::getMessage('SPOL_TPL_POSTID')?>:</span>
											<span class="sale-order-list-shipment-id"><?=htmlspecialcharsbx($shipment['TRACKING_NUMBER'])?></span>
											<span class="sale-order-list-shipment-id-icon"></span>
										</div>
										<?
									}
									?>
								</div>
								<?
								if ($shipment['TRACKING_URL'] <> '')
								{
									?>
									<div class="col-md-2 col-md-offset-1 col-sm-12 sale-order-list-shipment-button-container">
										<a class="sale-order-list-shipment-button" target="_blank" href="<?=$shipment['TRACKING_URL']?>">
											<?=Loc::getMessage('SPOL_TPL_CHECK_POSTID')?>
										</a>
									</div>
									<?
								}
								?>
							</div>
							<?
						}
						?>
						<div class="row sale-order-list-inner-row">
							<? /* <div class="sale-order-list-top-border"></div> */?>
							<div class="col-md-<?=($order['ORDER']['CAN_CANCEL'] !== 'N') ? 8 : 10?>  col-sm-12 sale-order-list-about-container">
								<a class="sale-order-list-about-link" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_DETAIL"])?>"><?=Loc::getMessage('SPOL_TPL_MORE_ON_ORDER')?></a>
							</div>
							<div class="col-md-2 col-sm-12 sale-order-list-repeat-container">
								<a class="sale-order-list-repeat-link" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"])?>"><?=Loc::getMessage('SPOL_TPL_REPEAT_ORDER')?></a>
							</div>
							<?
							if ($order['ORDER']['CAN_CANCEL'] !== 'N')
							{
								?>
								<div class="col-md-2 col-sm-12 sale-order-list-cancel-container">
									<a class="sale-order-list-cancel-link" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_CANCEL"])?>"><?=Loc::getMessage('SPOL_TPL_CANCEL_ORDER')?></a>
								</div>
								<?
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<?
		}
	}
	else
	{
		$orderHeaderStatus = null;

		if ($filterShowCanceled === 'Y' && !empty($arResult['ORDERS']))
		{
			?>
			<h1 class="sale-order-title">
				<?= Loc::getMessage('SPOL_TPL_ORDERS_CANCELED_HEADER') ?>
			</h1>
			<?
		}

		foreach ($arResult['ORDERS'] as $key => $order)
		{
			if ($orderHeaderStatus !== $order['ORDER']['STATUS_ID'] && $filterShowCanceled !== 'Y')
			{
				$orderHeaderStatus = $order['ORDER']['STATUS_ID'];
				?>
				<h1 class="sale-order-title">
					<?= Loc::getMessage('SPOL_TPL_ORDER_IN_STATUSES') ?> &laquo;<?=htmlspecialcharsbx($arResult['INFO']['STATUS'][$orderHeaderStatus]['NAME'])?>&raquo;
				</h1>
				<?
			}
			?>
			<div class="col-md-12 col-sm-12 sale-order-list-container">
				<div class="row">
					<div class="col-md-12 col-sm-12 sale-order-list-accomplished-title-container">
						<div class="row">
							<div class="col-md-8 col-sm-12 sale-order-list-accomplished-title-container">
								<h2 class="sale-order-list-accomplished-title">
									<?= Loc::getMessage('SPOL_TPL_ORDER') ?>
									<?= Loc::getMessage('SPOL_TPL_NUMBER_SIGN') ?>
									<?= htmlspecialcharsbx($order['ORDER']['ACCOUNT_NUMBER'])?>
									<?= Loc::getMessage('SPOL_TPL_FROM_DATE') ?>
									<?= $order['ORDER']['DATE_INSERT'] ?>,
									<?= count($order['BASKET_ITEMS']); ?>
									<?
									$count = mb_substr(count($order['BASKET_ITEMS']), -1);
									if ($count == '1')
									{
										echo Loc::getMessage('SPOL_TPL_GOOD');
									}
									elseif ($count >= '2' || $count <= '4')
									{
										echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
									}
									else
									{
										echo Loc::getMessage('SPOL_TPL_GOODS');
									}
									?>
									<?= Loc::getMessage('SPOL_TPL_SUMOF') ?>
									<?= $order['ORDER']['FORMATED_PRICE'] ?>
								</h2>
							</div>
							<div class="col-md-4 col-sm-12 sale-order-list-accomplished-date-container">
								<?
								if ($filterShowCanceled !== 'Y')
								{
									?>
									<span class="sale-order-list-accomplished-date">
										<?= Loc::getMessage('SPOL_TPL_ORDER_FINISHED')?>
									</span>
									<?
								}
								else
								{
									?>
									<span class="sale-order-list-accomplished-date canceled-order">
										<?= Loc::getMessage('SPOL_TPL_ORDER_CANCELED')?>
									</span>
									<?
								}
								?>
								<span class="sale-order-list-accomplished-date-number"><?= $order['ORDER']['DATE_STATUS_FORMATED'] ?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 sale-order-list-inner-accomplished">
						<div class="row sale-order-list-inner-row">
							<div class="col-md-3 col-sm-12 sale-order-list-about-accomplished">
								<a class="sale-order-list-about-link" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_DETAIL"])?>">
									<?=Loc::getMessage('SPOL_TPL_MORE_ON_ORDER')?>
								</a>
							</div>
							<div class="col-md-3 col-md-offset-6 col-sm-12 sale-order-list-repeat-accomplished">
								<a class="sale-order-list-repeat-link sale-order-link-accomplished" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"])?>">
									<?=Loc::getMessage('SPOL_TPL_REPEAT_ORDER')?>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?
		}
	}
	?>
    </div>
	</div>
    </div>
	<div class="clearfix"></div>
	<?
	echo $arResult["NAV_STRING"];

	if ($filterHistory !== 'Y')
	{
		$javascriptParams = array(
			"url" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
			"templateFolder" => CUtil::JSEscape($templateFolder),
			"templateName" => $this->__component->GetTemplateName(),
			"paymentList" => $paymentChangeData,
			"returnUrl" => CUtil::JSEscape($arResult["RETURN_URL"]),
		);
		$javascriptParams = CUtil::PhpToJSObject($javascriptParams);
		?>
		<script>
			BX.Sale.PersonalOrderComponent.PersonalOrderList.init(<?=$javascriptParams?>);
		</script>
		<?
	}
}
