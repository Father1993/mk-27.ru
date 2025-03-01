<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponent $component */
/** @global CMain $APPLICATION */

use Bitrix\Main\Localization\Loc;

if ($arParams['SHOW_ORDER_PAGE'] !== 'Y')
{
	LocalRedirect($arParams['SEF_FOLDER']);
}

if ($arParams["MAIN_CHAIN_NAME"] !== '')
{
	$APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}

$APPLICATION->AddChainItem(Loc::getMessage("SPS_CHAIN_ORDERS"), $arResult['PATH_TO_ORDERS']);
$APPLICATION->IncludeComponent(
    "bitrix:sale.personal.order.list",
    "order_list",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ALLOW_INNER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "DEFAULT_SORT" => "STATUS",
        "DISALLOW_CANCEL" => "N",
        "HISTORIC_STATUSES" => array("F"),
        "ID" => $ID,
        "NAV_TEMPLATE" => "",
        "ONLY_INNER_FULL" => "N",
        "ORDERS_PER_PAGE" => "20",
        "PATH_TO_BASKET" => "",
        "PATH_TO_CANCEL" => "",
        "PATH_TO_CATALOG" => "/",
        "PATH_TO_COPY" => "",
        "PATH_TO_DETAIL" => "",
        "PATH_TO_PAYMENT" => "payment.php",
        "REFRESH_PRICES" => "N",
        "RESTRICT_CHANGE_PAYSYSTEM" => array("0"),
        "SAVE_IN_SESSION" => "Y",
        "SET_TITLE" => "Y",
        "STATUS_COLOR_F" => "gray",
        "STATUS_COLOR_N" => "green",
        "STATUS_COLOR_P" => "yellow",
        "STATUS_COLOR_PSEUDO_CANCELLED" => "red"
    )
    );?>
