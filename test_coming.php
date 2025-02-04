<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ТЕСТ ПРИХОД");
?>

<?php // Не доработанный функционал, не используется. ?>
 
<?php 
global $USER;
if ($USER->IsAdmin())
{
    ?>
    
    <?php 
    
    if ($city_code == "ysl") {
        $price_type = "Сахалин ОПТ";
    } else {
        $price_type = "Розничная Ф";
    }
    
    ?>
    
    <?php 
    
    if(CModule::IncludeModule("iblock"))
    {
        $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 18, "ID" => 9539), false, false, Array("ID", "PROPERTY_SECTION_ID_LIST"));
    }
    while ($arItem = $res->fetch())
    {
        $arSectionId[] = $arItem['PROPERTY_SECTION_ID_LIST_VALUE'];
    }
    
    pprint ($arSectionId);
    
    GLOBAL $arNewProductFilter;
    $arNewProductFilter['!DETAIL_PICTURE'] = false;
    $arNewProductFilter[">CATALOG_QUANTITY"] = 0;
    $arNewProductFilter["!CATALOG_PRICE_2"] = false;
    $arNewProductFilter["=SECTION_ID"] = $arSectionId;
    
    ?>
    
    <div class="main-new-products-head">
        <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        	"PATH" => SITE_TEMPLATE_PATH . "/include/main/main_coming_slider_title.php"
        ));?>
    </div>
    
        <?$APPLICATION->IncludeComponent(
    	"bitrix:catalog.section", 
    	"main_coming_slider", 
    	array(
    		"ACTION_VARIABLE" => "action",
    		"ADD_PICT_PROP" => "-",
    		"ADD_PROPERTIES_TO_BASKET" => "Y",
    		"ADD_SECTIONS_CHAIN" => "N",
    		"ADD_TO_BASKET_ACTION" => "ADD",
    		"AJAX_MODE" => "N",
    		"AJAX_OPTION_ADDITIONAL" => "",
    		"AJAX_OPTION_HISTORY" => "N",
    		"AJAX_OPTION_JUMP" => "N",
    		"AJAX_OPTION_STYLE" => "Y",
    		"BACKGROUND_IMAGE" => "-",
    		"BASKET_URL" => "/personal/basket.php",
    		"BROWSER_TITLE" => "-",
    		"CACHE_FILTER" => "N",
    		"CACHE_GROUPS" => "Y",
    		"CACHE_TIME" => "36000000",
    		"CACHE_TYPE" => "A",
    		"COMPATIBLE_MODE" => "Y",
    		"CONVERT_CURRENCY" => "N",
    		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
    		"DETAIL_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/",
    		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
    		"DISPLAY_BOTTOM_PAGER" => "N",
    		"DISPLAY_COMPARE" => "N",
    		"DISPLAY_TOP_PAGER" => "N",
    		"ELEMENT_SORT_FIELD" => "created",
    		"ELEMENT_SORT_FIELD2" => "id",
    		"ELEMENT_SORT_ORDER" => "desc",
    		"ELEMENT_SORT_ORDER2" => "desc",
    		"ENLARGE_PRODUCT" => "STRICT",
    		"FILTER_NAME" => "arNewProductFilter",
    		"HIDE_NOT_AVAILABLE" => "N",
    		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
    		"IBLOCK_ID" => "13",
    		"IBLOCK_TYPE" => "catalog",
    		"INCLUDE_SUBSECTIONS" => "N",
    		"LABEL_PROP" => "",
    		"LAZY_LOAD" => "N",
    		"LINE_ELEMENT_COUNT" => "100",
    		"LOAD_ON_SCROLL" => "N",
    		"MESSAGE_404" => "",
    		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
    		"MESS_BTN_BUY" => "Купить",
    		"MESS_BTN_DETAIL" => "Подробнее",
    		"MESS_BTN_SUBSCRIBE" => "Подписаться",
    		"MESS_NOT_AVAILABLE" => "Нет в наличии",
    		"META_DESCRIPTION" => "-",
    		"META_KEYWORDS" => "-",
    		"OFFERS_LIMIT" => "5",
    		"PAGER_BASE_LINK_ENABLE" => "N",
    		"PAGER_DESC_NUMBERING" => "N",
    		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    		"PAGER_SHOW_ALL" => "N",
    		"PAGER_SHOW_ALWAYS" => "N",
    		"PAGER_TEMPLATE" => ".default",
    		"PAGER_TITLE" => "Товары",
    		"PAGE_ELEMENT_COUNT" => "100",
    		"PARTIAL_PRODUCT_PROPERTIES" => "N", 
    	    "PRICE_CODE" => array(
    	        0 => "$price_type",
    	    ),
    		"PRICE_VAT_INCLUDE" => "Y",
    		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
    		"PRODUCT_ID_VARIABLE" => "id",
    		"PRODUCT_PROPS_VARIABLE" => "prop",
    		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
    		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'6','BIG_DATA':false},{'VARIANT':'6','BIG_DATA':false},{'VARIANT':'6','BIG_DATA':false}]",
    		"PRODUCT_SUBSCRIPTION" => "Y",
    		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
    		"RCM_TYPE" => "personal",
    		"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
    		"SECTION_ID" => "",
    		"SECTION_ID_VARIABLE" => "SECTION_CODE",
    		"SECTION_URL" => "#SECTION_CODE#/",
    		"SECTION_USER_FIELDS" => array(
    			0 => "",
    			1 => "",
    		),
    		"SEF_MODE" => "N",
    		"SET_BROWSER_TITLE" => "N",
    		"SET_LAST_MODIFIED" => "N",
    		"SET_META_DESCRIPTION" => "N",
    		"SET_META_KEYWORDS" => "N",
    		"SET_STATUS_404" => "Y",
    		"SET_TITLE" => "N",
    		"SHOW_404" => "N",
    		"SHOW_ALL_WO_SECTION" => "N",
    		"SHOW_CLOSE_POPUP" => "N",
    		"SHOW_DISCOUNT_PERCENT" => "N",
    		"SHOW_FROM_SECTION" => "N",
    		"SHOW_MAX_QUANTITY" => "N",
    		"SHOW_OLD_PRICE" => "N",
    		"SHOW_PRICE_COUNT" => "1",
    		"SHOW_SLIDER" => "Y",
    		"SLIDER_INTERVAL" => "3000",
    		"SLIDER_PROGRESS" => "N",
    		"TEMPLATE_THEME" => "blue",
    		"USE_ENHANCED_ECOMMERCE" => "N",
    		"USE_MAIN_ELEMENT_SECTION" => "Y",
    		"USE_PRICE_COUNT" => "N",
    		"USE_PRODUCT_QUANTITY" => "N",
    		"COMPONENT_TEMPLATE" => "main_new_products",
    		"SEF_RULE" => "/#SECTION_CODE#",
    		"SECTION_CODE_PATH" => "",
    		"OFFERS_SORT_FIELD" => "sort",
    		"OFFERS_SORT_ORDER" => "asc",
    		"OFFERS_SORT_FIELD2" => "id",
    		"OFFERS_SORT_ORDER2" => "desc",
    		"OFFERS_FIELD_CODE" => array(
    			0 => "",
    			1 => "",
    		)
    	),
    	false
    );?>
    
<?php }?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>