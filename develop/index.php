<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Собственное производство");
?>

<div class="page-banner">

  <div class="page-banner-list desktop"></div>

  <div class="page-banner-text">
    <h1>
      <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        		"PATH" => SITE_TEMPLATE_PATH . "/include/develop/banner_text.php"
        	));?>
    </h1>
  </div>

  <div class="page-banner-map desktop"></div>

</div>

<div class="page-main-block container develop no-padding-container">

  <section>
    <h2>
      <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        		"PATH" => SITE_TEMPLATE_PATH . "/include/develop/main_block_1_title.php"
        	));?>
    </h2>
    <div class="text">
      <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        		"PATH" => SITE_TEMPLATE_PATH . "/include/develop/main_block_1_text.php"
        	));?>
    </div>
  </section>

  <?$APPLICATION->IncludeComponent(
    	"bitrix:news.list",
    	"mini_gallery",
    	Array(
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
    		"CHECK_DATES" => "N",
    		"DETAIL_URL" => "",
    		"DISPLAY_BOTTOM_PAGER" => "N",
    		"DISPLAY_DATE" => "N",
    		"DISPLAY_NAME" => "N",
    		"DISPLAY_PICTURE" => "N",
    		"DISPLAY_PREVIEW_TEXT" => "N",
    		"DISPLAY_TOP_PAGER" => "N",
    		"FIELD_CODE" => array("DETAIL_PICTURE",""),
    		"FILTER_NAME" => "",
    		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
    		"IBLOCK_ID" => "8",
    		"IBLOCK_TYPE" => "images",
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
    		"PROPERTY_CODE" => array("",""),
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
    		"STRICT_SECTION_CHECK" => "N"
    	)
    );?>

</div>

<!-- Блок обратной связи -->
<section class="production-contact">
  <div class="container">
    <div class="contact-wrapper">
      <h2>Остались вопросы?</h2>
      <p>Наши специалисты готовы рассказать подробнее о возможностях производства и ответить на все вопросы</p>
      <div class="contact-buttons">
        <a href="tel:+74212919043" class="contact-phone">
          <i class="bi bi-telephone"></i>
          +7 (4212) 91-90-43
        </a>
        <a href="mailto:info@mk-27.ru" class="contact-email">
          <i class="bi bi-envelope"></i>
          info@mk-27.ru
        </a>
      </div>
    </div>
  </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>