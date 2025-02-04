<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Команда МК");
?>

<?php // Список сотрудников с email-адресами и паролями ?>

<?php if ($_GET["CODE"] == "141a249f0e88c75ee26ec50f16274a79"): ?>
    
    <?$APPLICATION->IncludeComponent(
    	"bitrix:news.list", 
    	"team_service", 
    	array(
    		"ACTIVE_DATE_FORMAT" => "d.m.Y",
    		"ADD_SECTIONS_CHAIN" => "N",
    		"AJAX_MODE" => "N",
    		"AJAX_OPTION_ADDITIONAL" => "",
    		"AJAX_OPTION_HISTORY" => "N",
    		"AJAX_OPTION_JUMP" => "N",
    		"AJAX_OPTION_STYLE" => "Y",
    		"CACHE_FILTER" => "N",
    		"CACHE_GROUPS" => "Y",
    		"CACHE_TIME" => "36000000",
    		"CACHE_TYPE" => "A",
    		"CHECK_DATES" => "Y",
    		"DETAIL_URL" => "",
    		"DISPLAY_BOTTOM_PAGER" => "N",
    		"DISPLAY_DATE" => "N",
    		"DISPLAY_NAME" => "N",
    		"DISPLAY_PICTURE" => "N",
    		"DISPLAY_PREVIEW_TEXT" => "N",
    		"DISPLAY_TOP_PAGER" => "N",
    		"FIELD_CODE" => array(
    			0 => "NAME",
    			1 => "DETAIL_PICTURE",
    			2 => "",
    		),
    		"FILTER_NAME" => "arrFilterHTeam",
    		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
    		"IBLOCK_ID" => "7",
    		"IBLOCK_TYPE" => "info",
    		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    		"INCLUDE_SUBSECTIONS" => "Y",
    		"MESSAGE_404" => "",
    		"NEWS_COUNT" => "100",
    		"PAGER_BASE_LINK_ENABLE" => "N",
    		"PAGER_DESC_NUMBERING" => "N",
    		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    		"PAGER_SHOW_ALL" => "N",
    		"PAGER_SHOW_ALWAYS" => "N",
    		"PAGER_TEMPLATE" => ".default",
    		"PAGER_TITLE" => "Новости",
    		"PARENT_SECTION" => "",
    		"PARENT_SECTION_CODE" => "",
    		"PREVIEW_TRUNCATE_LEN" => "",
    		"PROPERTY_CODE" => array(
    			0 => "EMAIL",
    			1 => "PHONE_PLUS_CODE_2",
    			2 => "CITY",
    			3 => "POSITION",
    			4 => "PHONE_PLUS_CODE",
    			5 => "PASSWORD",
    		),
    		"SET_BROWSER_TITLE" => "N",
    		"SET_LAST_MODIFIED" => "N",
    		"SET_META_DESCRIPTION" => "N",
    		"SET_META_KEYWORDS" => "N",
    		"SET_STATUS_404" => "N",
    		"SET_TITLE" => "N",
    		"SHOW_404" => "N",
    		"SORT_BY1" => "SORT",
    		"SORT_BY2" => "SORT",
    		"SORT_ORDER1" => "ASC",
    		"SORT_ORDER2" => "ASC",
    		"STRICT_SECTION_CHECK" => "N",
    		"COMPONENT_TEMPLATE" => "team"
    	),
    	false
    );?>

<?php endif; ?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>