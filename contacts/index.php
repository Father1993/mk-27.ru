<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");

$APPLICATION->SetAdditionalCSS ("/contacts/contacts.css");
$APPLICATION->AddHeadScript ("/contacts/contacts.js");

if ($city_code == "khb") $active_khb = "active";
if ($city_code == "vld") $active_vld = "active";
if ($city_code == "ysl") $active_ysl = "active";

?>

<div class="new-contacts">

  <h1>Контакты</h1>

  <div class="container no-padding-container">
    <div class="row">
      <div class="col-12 col-md-4">
        <div class="city-change city-change-khb <?=$active_khb?>" onclick="change_city('khb');">Хабаровск</div>
      </div>
      <div class="col-12 col-md-4">
        <div class="city-change city-change-vld <?=$active_vld?>" onclick="change_city('vld');">Владивосток</div>
      </div>
      <div class="col-12 col-md-4">
        <div class="city-change city-change-ysl <?=$active_ysl?>" onclick="change_city('ysl');">Южно-Сахалинск</div>
      </div>
    </div>
  </div>

  <?php
  // Проверяем наличие активных элементов режима работы
  $hasActiveHolidayKhb = false;
  $hasActiveHolidayVld = false;
  $hasActiveHolidayYsl = false;
  
  $rsHoliday = CIBlockElement::GetList(
      array("SORT" => "ASC"),
      array("IBLOCK_ID" => 670, "ACTIVE" => "Y"),
      false,
      false,
      array("ID")
  );
  
  while($arHoliday = $rsHoliday->GetNext()) {
      if ($arHoliday["ID"] == 1197415) {
          $hasActiveHolidayKhb = true;
      }
      if ($arHoliday["ID"] == 1197416) {
          $hasActiveHolidayVld = true;
      }
      if ($arHoliday["ID"] == 1197417) {
          $hasActiveHolidayYsl = true;
      }
  }
  
  // Проверяем наличие активного элемента для Хабаровска
  if ($hasActiveHolidayKhb):
  ?>
  <!-- Блок с режимом работы для Хабаровска -->
  <div class="holiday-block holiday-block-khb <?=$active_khb?>">
    <?php 
      global $arrFilterHoliday;
      $arrFilterHoliday = array(
          "ID" => 1157259,
          "ACTIVE" => "Y"
      );
    ?>

    <?$APPLICATION->IncludeComponent(
      "bitrix:news.list", 
      "holiday_schedule", 
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
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(
          0 => "",
          1 => "",
        ),
        "FILTER_NAME" => "arrFilterHoliday",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "670", // ID инфоблока "Режимы работы"
        "IBLOCK_TYPE" => "info",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "1",
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
          0 => "KOD_GORODA",
          1 => "GOROD",
          2 => "",
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
      ),
      false
    );?>
  </div>
  <?php endif; ?>

  <?php
  // Проверяем наличие активного элемента для Владивостока
  if ($hasActiveHolidayVld):
  ?>
  <!-- Блок с режимом работы для Владивостока -->
  <div class="holiday-block holiday-block-vld <?=$active_vld?>">
    <?php 
      global $arrFilterHoliday;
      $arrFilterHoliday = array(
          "ID" => 1157260,
          "ACTIVE" => "Y"
      );
    ?>

    <?$APPLICATION->IncludeComponent(
      "bitrix:news.list", 
      "holiday_schedule", 
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
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(
          0 => "",
          1 => "",
        ),
        "FILTER_NAME" => "arrFilterHoliday",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "670", // ID инфоблока "Режимы работы"
        "IBLOCK_TYPE" => "info",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "1",
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
          0 => "KOD_GORODA",
          1 => "GOROD",
          2 => "",
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
      ),
      false
    );?>
  </div>
  <?php endif; ?>

  <?php
  // Проверяем наличие активного элемента для Южно-Сахалинска
  if ($hasActiveHolidayYsl):
  ?>
  <!-- Блок с режимом работы для Южно-Сахалинска -->
  <div class="holiday-block holiday-block-ysl <?=$active_ysl?>">
    <?php 
      global $arrFilterHoliday;
      $arrFilterHoliday = array(
          "ID" => 1157261,
          "ACTIVE" => "Y"
      );
    ?>

    <?$APPLICATION->IncludeComponent(
      "bitrix:news.list", 
      "holiday_schedule", 
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
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(
          0 => "",
          1 => "",
        ),
        "FILTER_NAME" => "arrFilterHoliday",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "670", // ID инфоблока "Режимы работы"
        "IBLOCK_TYPE" => "info",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "1",
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
          0 => "KOD_GORODA",
          1 => "GOROD",
          2 => "",
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
      ),
      false
    );?>
  </div>
  <?php endif; ?>

  <div class="contacts contacts-khb <?=$active_khb?>">

    <?php $contacts_city_name = "Хабаровск"; ?>
    <?php $contacts_city_code = "khb"; ?>

    <?php 
    		global $arrFilterContacts;
    		$arrFilterContacts = array(
    		    "PROPERTY_CITY_VALUE" => $contacts_city_name
    		);
		?>

    <?$APPLICATION->IncludeComponent(
        	"bitrix:news.list", 
        	"my_contacts", 
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
        			0 => "",
        			1 => "",
        		),
        		"FILTER_NAME" => "arrFilterContacts",
        		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
        		"IBLOCK_ID" => "15",
        		"IBLOCK_TYPE" => "info",
        		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        		"INCLUDE_SUBSECTIONS" => "N",
        		"MESSAGE_404" => "",
        		"NEWS_COUNT" => "20",
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
        			0 => "ADDRESS",
        			1 => "CITY",
        			2 => "PHONE",
        		    3 => "EMAIL",
        		    4 => "SCHEDULE",
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
        		"COMPONENT_TEMPLATE" => "contacts"
        	),
        	false
        );?>

    <?php 
		global $arrFilterHTeam;
		$arrFilterHTeam = array(
		    "PROPERTY_CITY_VALUE" => $contacts_city_name
		);
		?>

    <?$APPLICATION->IncludeComponent(
        	"bitrix:news.list", 
        	"my_team", 
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
        			5 => "",
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

  </div>

  <div class="contacts contacts-vld <?=$active_vld?>">

    <?php $contacts_city_name = "Владивосток"; ?>
    <?php $contacts_city_code = "vld"; ?>

    <?php 
    		global $arrFilterContacts;
    		$arrFilterContacts = array(
    		    "PROPERTY_CITY_VALUE" => $contacts_city_name
    		);
		?>

    <?$APPLICATION->IncludeComponent(
        	"bitrix:news.list", 
        	"my_contacts", 
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
        			0 => "",
        			1 => "",
        		),
        		"FILTER_NAME" => "arrFilterContacts",
        		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
        		"IBLOCK_ID" => "15",
        		"IBLOCK_TYPE" => "info",
        		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        		"INCLUDE_SUBSECTIONS" => "N",
        		"MESSAGE_404" => "",
        		"NEWS_COUNT" => "20",
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
        			0 => "ADDRESS",
        			1 => "CITY",
        			2 => "PHONE",
        			3 => "EMAIL",
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
        		"COMPONENT_TEMPLATE" => "contacts"
        	),
        	false
        );?>

    <?php 
		global $arrFilterHTeam;
		$arrFilterHTeam = array(
		    "PROPERTY_CITY_VALUE" => $contacts_city_name
		);
		?>

    <?$APPLICATION->IncludeComponent(
        	"bitrix:news.list", 
        	"my_team", 
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
        			5 => "",
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

  </div>

  <div class="contacts contacts-ysl <?=$active_ysl?>">

    <?php $contacts_city_name = "Южно-Сахалинск"; ?>
    <?php $contacts_city_code = "ysl"; ?>

    <?php 
    		global $arrFilterContacts;
    		$arrFilterContacts = array(
    		    "PROPERTY_CITY_VALUE" => $contacts_city_name
    		);
		?>

    <?$APPLICATION->IncludeComponent(
        	"bitrix:news.list", 
        	"my_contacts", 
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
        			0 => "",
        			1 => "",
        		),
        		"FILTER_NAME" => "arrFilterContacts",
        		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
        		"IBLOCK_ID" => "15",
        		"IBLOCK_TYPE" => "info",
        		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        		"INCLUDE_SUBSECTIONS" => "N",
        		"MESSAGE_404" => "",
        		"NEWS_COUNT" => "20",
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
        			0 => "ADDRESS",
        			1 => "CITY",
        			2 => "PHONE",
        			3 => "EMAIL",
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
        		"COMPONENT_TEMPLATE" => "contacts"
        	),
        	false
        );?>

    <?php 
		global $arrFilterHTeam;
		$arrFilterHTeam = array(
		    "PROPERTY_CITY_VALUE" => $contacts_city_name
		);
		?>

    <?$APPLICATION->IncludeComponent(
        	"bitrix:news.list", 
        	"my_team", 
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
        			5 => "",
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

  </div>

</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>