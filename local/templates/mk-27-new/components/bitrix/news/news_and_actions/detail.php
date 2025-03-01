<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
	Array(
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
		'STRICT_SECTION_CHECK' => (isset($arParams['STRICT_SECTION_CHECK']) ? $arParams['STRICT_SECTION_CHECK'] : ''),
	),
	$component
);?>
<?php /* ?>
<p><a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"]?>"><span class="news-back-arrow">➜</span> Вернуться к списку</a></p>
<?php */ ?>
<?if($arParams["USE_RATING"]=="Y" && $ElementID):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.vote",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_ID" => $ElementID,
		"MAX_VOTE" => $arParams["MAX_VOTE"],
		"VOTE_NAMES" => $arParams["VOTE_NAMES"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
	),
	$component
);?>
<?endif?>
<?if($arParams["USE_CATEGORIES"]=="Y" && $ElementID):
	global $arCategoryFilter;
	$obCache = new CPHPCache;
	$strCacheID = $componentPath.LANG.$arParams["IBLOCK_ID"].$ElementID.$arParams["CATEGORY_CODE"];
	if(($tzOffset = CTimeZone::GetOffset()) <> 0)
		$strCacheID .= "_".$tzOffset;
	if($arParams["CACHE_TYPE"] == "N" || $arParams["CACHE_TYPE"] == "A" && COption::GetOptionString("main", "component_cache_on", "Y") == "N")
		$CACHE_TIME = 0;
	else
		$CACHE_TIME = $arParams["CACHE_TIME"];
	if($obCache->StartDataCache($CACHE_TIME, $strCacheID, $componentPath))
	{
		$rsProperties = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $ElementID, "sort", "asc", array("ACTIVE"=>"Y","CODE"=>$arParams["CATEGORY_CODE"]));
		$arCategoryFilter = array();
		while($arProperty = $rsProperties->Fetch())
		{
			if(is_array($arProperty["VALUE"]) && count($arProperty["VALUE"])>0)
			{
				foreach($arProperty["VALUE"] as $value)
					$arCategoryFilter[$value]=true;
			}
			elseif(!is_array($arProperty["VALUE"]) && $arProperty["VALUE"] <> '')
				$arCategoryFilter[$arProperty["VALUE"]]=true;
		}
		$obCache->EndDataCache($arCategoryFilter);
	}
	else
	{
		$arCategoryFilter = $obCache->GetVars();
	}
	if(count($arCategoryFilter)>0):
		$arCategoryFilter = array(
			"PROPERTY_".$arParams["CATEGORY_CODE"] => array_keys($arCategoryFilter),
			"!"."ID" => $ElementID,
		);
		?>
		<hr /><h3><?=GetMessage("CATEGORIES")?></h3>
		<?foreach($arParams["CATEGORY_IBLOCK"] as $iblock_id):?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				$arParams["CATEGORY_THEME_".$iblock_id],
				Array(
					"IBLOCK_ID" => $iblock_id,
					"NEWS_COUNT" => $arParams["CATEGORY_ITEMS_COUNT"],
					"SET_TITLE" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"FILTER_NAME" => "arCategoryFilter",
					"CACHE_FILTER" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
				),
				$component
			);?>
		<?endforeach?>
	<?endif?>
<?endif?>
<?if($arParams["USE_REVIEW"]=="Y" && IsModuleInstalled("forum") && $ElementID):?>
<hr />
<?$APPLICATION->IncludeComponent(
	"bitrix:forum.topic.reviews",
	"",
	Array(
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
		"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
		"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
		"FORUM_ID" => $arParams["FORUM_ID"],
		"URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
		"SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
		"DATE_TIME_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"ELEMENT_ID" => $ElementID,
		"AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"URL_TEMPLATES_DETAIL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
	),
	$component
);?>
<?endif?>

<?php if ($arResult["VARIABLES"]["ELEMENT_CODE"] == "novogodniy-zvezdopad"): ?>
    
    <?$APPLICATION->IncludeComponent(
    	"bitrix:catalog.element", 
    	"action_winners", 
    	array(
    		"ACTION_VARIABLE" => "action",
    		"ADDITIONAL_FILTER_NAME" => "elementFilter",
    		"ADD_DETAIL_TO_SLIDER" => "N",
    		"ADD_ELEMENT_CHAIN" => "N",
    		"ADD_PICT_PROP" => "-",
    		"ADD_PROPERTIES_TO_BASKET" => "Y",
    		"ADD_SECTIONS_CHAIN" => "Y",
    		"ADD_TO_BASKET_ACTION" => array(
    			0 => "BUY",
    		),
    		"ADD_TO_BASKET_ACTION_PRIMARY" => array(
    			0 => "BUY",
    		),
    		"BACKGROUND_IMAGE" => "-",
    		"BASKET_URL" => "/personal/basket.php",
    		"BRAND_USE" => "N",
    		"BROWSER_TITLE" => "-",
    		"CACHE_GROUPS" => "Y",
    		"CACHE_TIME" => "36000000",
    		"CACHE_TYPE" => "A",
    		"CHECK_SECTION_ID_VARIABLE" => "N",
    		"COMPATIBLE_MODE" => "Y",
    		"CONVERT_CURRENCY" => "N",
    		"DETAIL_PICTURE_MODE" => array(
    			0 => "POPUP",
    			1 => "MAGNIFIER",
    		),
    		"DETAIL_URL" => "",
    		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
    		"DISPLAY_COMPARE" => "N",
    		"DISPLAY_NAME" => "Y",
    		"DISPLAY_PREVIEW_TEXT_MODE" => "E",
    		"ELEMENT_CODE" => "pobediteli-novogodney-aktsii-2022",
    		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
    		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
    		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
    		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
    		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
    		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
    		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
    		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
    		"GIFTS_MESS_BTN_BUY" => "Выбрать",
    		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
    		"GIFTS_SHOW_IMAGE" => "Y",
    		"GIFTS_SHOW_NAME" => "Y",
    		"GIFTS_SHOW_OLD_PRICE" => "Y",
    		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
    		"IBLOCK_ID" => "27",
    		"IBLOCK_TYPE" => "images",
    		"IMAGE_RESOLUTION" => "16by9",
    		"LABEL_PROP" => array(
    		),
    		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
    		"LINK_IBLOCK_ID" => "",
    		"LINK_IBLOCK_TYPE" => "",
    		"LINK_PROPERTY_SID" => "",
    		"MESSAGE_404" => "",
    		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
    		"MESS_BTN_BUY" => "Купить",
    		"MESS_BTN_SUBSCRIBE" => "Подписаться",
    		"MESS_COMMENTS_TAB" => "Комментарии",
    		"MESS_DESCRIPTION_TAB" => "Описание",
    		"MESS_NOT_AVAILABLE" => "Нет в наличии",
    		"MESS_PRICE_RANGES_TITLE" => "Цены",
    		"MESS_PROPERTIES_TAB" => "Характеристики",
    		"META_DESCRIPTION" => "-",
    		"META_KEYWORDS" => "-",
    		"OFFERS_LIMIT" => "0",
    		"PARTIAL_PRODUCT_PROPERTIES" => "N",
    		"PRICE_CODE" => array(
    		),
    		"PRICE_VAT_INCLUDE" => "Y",
    		"PRICE_VAT_SHOW_VALUE" => "N",
    		"PRODUCT_ID_VARIABLE" => "id",
    		"PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
    		"PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
    		"PRODUCT_PROPS_VARIABLE" => "prop",
    		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
    		"PRODUCT_SUBSCRIPTION" => "Y",
    		"SECTION_CODE" => "",
    		"SECTION_ID" => $_REQUEST["SECTION_ID"],
    		"SECTION_ID_VARIABLE" => "SECTION_ID",
    		"SECTION_URL" => "",
    		"SEF_MODE" => "N",
    		"SET_BROWSER_TITLE" => "Y",
    		"SET_CANONICAL_URL" => "N",
    		"SET_LAST_MODIFIED" => "N",
    		"SET_META_DESCRIPTION" => "Y",
    		"SET_META_KEYWORDS" => "Y",
    		"SET_STATUS_404" => "N",
    		"SET_TITLE" => "Y",
    		"SET_VIEWED_IN_COMPONENT" => "N",
    		"SHOW_404" => "N",
    		"SHOW_CLOSE_POPUP" => "N",
    		"SHOW_DEACTIVATED" => "N",
    		"SHOW_DISCOUNT_PERCENT" => "N",
    		"SHOW_MAX_QUANTITY" => "N",
    		"SHOW_OLD_PRICE" => "N",
    		"SHOW_PRICE_COUNT" => "1",
    		"SHOW_SKU_DESCRIPTION" => "N",
    		"SHOW_SLIDER" => "N",
    		"STRICT_SECTION_CHECK" => "N",
    		"TEMPLATE_THEME" => "blue",
    		"USE_COMMENTS" => "N",
    		"USE_ELEMENT_COUNTER" => "Y",
    		"USE_ENHANCED_ECOMMERCE" => "N",
    		"USE_GIFTS_DETAIL" => "Y",
    		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
    		"USE_MAIN_ELEMENT_SECTION" => "N",
    		"USE_PRICE_COUNT" => "N",
    		"USE_PRODUCT_QUANTITY" => "N",
    		"USE_RATIO_IN_RANGES" => "N",
    		"USE_VOTE_RATING" => "N",
    		"COMPONENT_TEMPLATE" => "action_winners"
    	),
    	false
    );?>
<?php endif; ?>