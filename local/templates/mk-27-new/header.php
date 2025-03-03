<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];

global $page;
$page = explode("/", $APPLICATION->GetCurPage())[1];
$page2 = explode("/", $APPLICATION->GetCurPage())[2];

if (empty($page)) {
	global $main;
	$main = true;
}

// Тип цен Сахалин ОПТ или РОЗНИЦА
if (CModule::IncludeModule("iblock")) {
    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 35, "ID" => 53503), false, false, Array("ID", "PROPERTY_PRICE_TYPE"));
}
$arPriceTypeItem = $res->fetch();
global $priceTypeYsl;
$priceTypeYsl = $arPriceTypeItem["PROPERTY_PRICE_TYPE_VALUE"];

?>
<!DOCTYPE html>
<html lang="ru" dir="ltr" itemscope itemtype="http://schema.org/WebPage">

<head>
  <base href="<?=$url?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://mk-27.ru/">
  <meta property="og:site_name" content="Метиз Комплект">

  <link itemprop="url" href="<?=$url?>" />
  <link rel="canonical" href="<?=$url?>" />
  <link rel="shortcut icon" type="image/png" href="<?=SITE_TEMPLATE_PATH?>/assets/images/favicons/64.png" />
  <link rel="apple-touch-icon-precomposed" sizes="180x180"
    href="<?=SITE_TEMPLATE_PATH?>/assets/images/favicons/180.png" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152"
    href="<?=SITE_TEMPLATE_PATH?>/assets/images/favicons/152.png" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144"
    href="<?=SITE_TEMPLATE_PATH?>/assets/images/favicons/144.png" />
  <link rel="apple-touch-icon-precomposed" sizes="120x120"
    href="<?=SITE_TEMPLATE_PATH?>/assets/images/favicons/120.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114"
    href="<?=SITE_TEMPLATE_PATH?>/assets/images/favicons/114.png" />
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?=SITE_TEMPLATE_PATH?>/assets/images/favicons/76.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=SITE_TEMPLATE_PATH?>/assets/images/favicons/72.png" />
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?=SITE_TEMPLATE_PATH?>/assets/images/favicons/57.png" />
  <link rel="mask-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/images/favicons/safari-pinned-tab.svg" color="#ee3831">
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

  <?php $APPLICATION->ShowProperty("og-title"); ?>
  <?php $APPLICATION->ShowProperty("og-description"); ?>
  <?php $APPLICATION->ShowProperty("og-image"); ?>

  <?php
		
			use Bitrix\Main\UI\Extension;
			Extension::load('ui.bootstrap4');
			
			$APPLICATION->SetAdditionalCSS ("/bitrix/css/main/font-awesome.css");
			$APPLICATION->SetAdditionalCSS (SITE_TEMPLATE_PATH . "/assets/fonts/fonts.css");
			$APPLICATION->AddHeadScript (SITE_TEMPLATE_PATH . "/assets/plugins/jquery-3.6.0.min.js");
			$APPLICATION->SetAdditionalCSS (SITE_TEMPLATE_PATH . "/assets/plugins/fancybox/fancybox.css");
			$APPLICATION->AddHeadScript (SITE_TEMPLATE_PATH . "/assets/plugins/fancybox/fancybox.umd.js");
			$APPLICATION->AddHeadScript (SITE_TEMPLATE_PATH . "/script.js");

      $APPLICATION->SetAdditionalCSS (SITE_TEMPLATE_PATH . "/assets/plugins/owl_carousel/owl.carousel.min.css");
      $APPLICATION->SetAdditionalCSS (SITE_TEMPLATE_PATH . "/assets/plugins/owl_carousel/owl.theme.default.min.css");
      $APPLICATION->AddHeadScript (SITE_TEMPLATE_PATH . "/assets/plugins/owl_carousel/owl.carousel.min.js");
      $APPLICATION->AddHeadScript (SITE_TEMPLATE_PATH . "/assets/plugins/jquery.mask.min.js");
      $APPLICATION->AddHeadScript (SITE_TEMPLATE_PATH . "/assets/plugins/api.js");
			$APPLICATION->AddHeadScript (SITE_TEMPLATE_PATH . "/assets/plugins/jquery.validate.min.js");



      if ($page == "vakansii" || $page == "contacts") {
        $APPLICATION->AddHeadScript ("https://maps.api.2gis.ru/2.0/loader.js");
			}

		?>

  <?php $APPLICATION->ShowHead(); ?>

  <title itemprop="headline"><?php $APPLICATION->ShowTitle(); ?></title>

  <!-- Yandex.Metrika counter -->
  <script type="text/javascript">
  (function(m, e, t, r, i, k, a) {
    m[i] = m[i] || function() {
      (m[i].a = m[i].a || []).push(arguments)
    };
    m[i].l = 1 * new Date();
    for (var j = 0; j < document.scripts.length; j++) {
      if (document.scripts[j].src === r) {
        return;
      }
    }
    k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
  })
  (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

  ym(84934894, "init", {
    clickmap: true,
    trackLinks: true,
    accurateTrackBounce: true,
    webvisor: true,
    ecommerce: "dataLayer"
  });
  </script>
  <noscript>
    <div><img src="https://mc.yandex.ru/watch/84934894" style="position:absolute; left:-9999px;" alt="" /></div>
  </noscript>
  <!-- /Yandex.Metrika counter -->

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-GGCR8WCW8N"></script>
  <script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'G-GGCR8WCW8N');
  </script>

  <?php 
        global $USER;
        if (!$USER) $USER = new CUser();
        if (($USER->GetID() != 1) && ($USER->GetID() != 5016)):
        ?>
  <script src="//code.jivo.ru/widget/bPEQ6aHDNW" async></script>
  <?php endif; ?>

</head>

<body>

  <!-- Top.Mail.Ru counter -->
  <script type="text/javascript">
  var _tmr = window._tmr || (window._tmr = []);
  _tmr.push({
    id: "3300765",
    type: "pageView",
    start: (new Date()).getTime()
  });
  (function(d, w, id) {
    if (d.getElementById(id)) return;
    var ts = d.createElement("script");
    ts.type = "text/javascript";
    ts.async = true;
    ts.id = id;
    ts.src = "https://top-fwz1.mail.ru/js/code.js";
    var f = function() {
      var s = d.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(ts, s);
    };
    if (w.opera == "[object Opera]") {
      d.addEventListener("DOMContentLoaded", f, false);
    } else {
      f();
    }
  })(document, window, "tmr-code");
  </script>
  <noscript>
    <div><img src="https://top-fwz1.mail.ru/counter?id=3300765;js=na" style="position:absolute;left:-9999px;"
        alt="Top.Mail.Ru" /></div>
  </noscript>
  <!-- /Top.Mail.Ru counter -->

  <div itemprop="isPartOf" itemscope itemtype="https://schema.org/WebSite">
    <link itemprop="url" href="<?=$_SERVER['HTTP_HOST']?>" />
  </div>

  <?php $APPLICATION->ShowPanel(); ?>

  <div class="grey-background"></div>

  <header itemscope itemtype="http://schema.org/WPHeader">

    <div class="container no-padding-container">

      <?php if ($main): ?>

      <div class="logo">
        <a class="desktop" href="/">
          <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo-white.svg">
        </a>

        <div class="hamburger mobile" onclick="showMenu();">
          <div class="hamburger-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
              <path fill="#fff"
                d="M3 5a1 1 0 1 0 0 2h18a1 1 0 1 0 0-2H3zm0 6a1 1 0 1 0 0 2h18a1 1 0 1 0 0-2H3zm0 6a1 1 0 1 0 0 2h18a1 1 0 1 0 0-2H3z" />
            </svg>
          </div>
          <span class="cross">✖</span>
        </div>

        <a class="mobile" href="/">
          <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo-mobile.svg">
        </a>
      </div>

      <?php else: ?>

      <div class="logo logo-not-main">
        <a class="desktop" href="/">
          <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo-white.svg">
        </a>

        <div class="hamburger" onclick="showMenu();">
          <div class="hamburger-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
              <path fill="#fff"
                d="M3 5a1 1 0 1 0 0 2h18a1 1 0 1 0 0-2H3zm0 6a1 1 0 1 0 0 2h18a1 1 0 1 0 0-2H3zm0 6a1 1 0 1 0 0 2h18a1 1 0 1 0 0-2H3z" />
            </svg>
          </div>
          <span class="cross">✖</span>
        </div>

        <a class="mobile" href="/">
          <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo-mobile.svg">
        </a>

      </div>

      <?php endif; ?>

      <div class="header-main">

        <div class="header-phones desktop">
          <p class="fs-12">
            Звонок по г. <?=$city_name?> с 9:00 до 18:00
          </p>

          <?php 
                		global $arrFilterHeaderPhones;
                		$arrFilterHeaderPhones = array(
                		    "PROPERTY_CITY_VALUE" => $city_name
                		);
                		?>

          <?$APPLICATION->IncludeComponent(
            "bitrix:news.list", 
            "header_phones", 
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
              "FILTER_NAME" => "arrFilterHeaderPhones",
              "HIDE_LINK_WHEN_NO_DETAIL" => "N",
              "IBLOCK_ID" => "4",
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
                0 => "CITY",
                1 => "",
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
              "COMPONENT_TEMPLATE" => "header_phones"
            ),
            false
          );?>
        </div>

        <div class="header-menu desktop">
          <?$APPLICATION->IncludeComponent(
              "bitrix:menu",
              "header_menu",
              array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "top",
                "DELAY" => "N",
                "MAX_LEVEL" => "2",
                "MENU_CACHE_GET_VARS" => array(
                ),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "Y",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "top",
                "USE_EXT" => "N",
                "COMPONENT_TEMPLATE" => "header_menu"
              ),
              false
            );?>
        </div>

        <div class="header-city">
          <p class="city-text fs-12 desktop">Город:</p>
          <p class="city-selected fs-14 desktop" onclick="showCityChange();"><?=$city_name?></p>
          <div class="city-icon mobile" onclick="showCityChange();">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/location.svg">
          </div>

          <div class="header-city-change <?=$change_city_active?>">

            <div class="city-arrow"></div>

            <div class="first-block">

              <span class="your-city">
                Ваш город <b><?=$city_name?></b>?
              </span>

              <div class="buttons">
                <div class="button button-yes" onclick="selectCity('<?=$city_code?>');">Да</div>
                <div class="button button-no" onclick="showCitySelect();">Выбрать другой</div>
              </div>

            </div>

            <div class="second-block">
              <div class="cross" onclick="hideCityChange();">✖</div>
              <div class="title">Выберите город</div>

              <div class="select-city" onclick="selectCity('vld', true);">Владивосток</div>
              <div class="select-city" onclick="selectCity('khb', true);">Хабаровск</div>
              <div class="select-city" onclick="selectCity('ysl', true);">Южно-Сахалинск</div>
            </div>

          </div>

        </div>

        <div class="header-social desktop">
          <a href="https://wa.me/79145443019" target="_blank"><img
              src="<?=SITE_TEMPLATE_PATH?>/assets/images/ic-wa.svg"></a>
          <a href="https://t.me/metiz_komplekt27" target="_blank"><img
              src="<?=SITE_TEMPLATE_PATH?>/assets/images/ic-telegram.svg"></a>
        </div>

        <div class="header-search">
          <a href="/search/">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/ic-search.svg">
          </a>
        </div>

        <?$APPLICATION->IncludeComponent(
          "bitrix:sale.basket.basket.line", 
          "header_cart", 
          array(
            "HIDE_ON_BASKET_PAGES" => "N",
            "MAX_IMAGE_SIZE" => "70",
            "PATH_TO_AUTHORIZE" => "",
            "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
            "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
            "PATH_TO_PERSONAL" => SITE_DIR."personal/",
            "PATH_TO_PROFILE" => SITE_DIR."personal/",
            "PATH_TO_REGISTER" => SITE_DIR."login/",
            "POSITION_FIXED" => "N",
            "SHOW_AUTHOR" => "N",
            "SHOW_DELAY" => "N",
            "SHOW_EMPTY_VALUES" => "Y",
            "SHOW_IMAGE" => "Y",
            "SHOW_NOTAVAIL" => "N",
            "SHOW_NUM_PRODUCTS" => "Y",
            "SHOW_PERSONAL_LINK" => "N",
            "SHOW_PRICE" => "Y",
            "SHOW_PRODUCTS" => "N",
            "SHOW_REGISTRATION" => "N",
            "SHOW_SUMMARY" => "Y",
            "SHOW_TOTAL_PRICE" => "Y",
            "COMPONENT_TEMPLATE" => "main_cart"
          ),
          false
        );?>
        <div class="header-profile">
          <?php global $USER; if ($USER->IsAuthorized()): ?>
          <a href="/personal_section/index.php?SECTION=private">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/profile_logged.png">
            <div>Профиль</div>
          </a>
          <?php else: ?>
          <a class="log-reg-link" href="/personal_section/index.php?SECTION=private">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/profile.png">
            <div>Вход</div>
          </a>
          <?php endif; ?>
        </div>

      </div>

    </div>

  </header>

  <div class="main-menu-mobile-block mobile">

    <div class="main-menu-mobile">
      <div class="catalog" onclick="showMenuCatalog();">
        <h3>Каталог</h3><i class="arrow fa fa-angle-right"></i>
      </div>
    </div>

  </div>

  <div class="main-menu-mobile-catalog mobile">
    <div class="catalog-menu">

      <?$APPLICATION->IncludeComponent(
        "bitrix:menu", 
        "main_catalog_menu_mobile",
        array(
          "ALLOW_MULTI_SELECT" => "N",
          "CHILD_MENU_TYPE" => "left",
          "DELAY" => "N",
          "MAX_LEVEL" => "1",
          "MENU_CACHE_GET_VARS" => array(
          ),
          "MENU_CACHE_TIME" => "36000000",
          "MENU_CACHE_TYPE" => "A",
          "MENU_CACHE_USE_GROUPS" => "Y",
          "ROOT_MENU_TYPE" => "left",
          "USE_EXT" => "Y",
          "COMPONENT_TEMPLATE" => "main_catalog_menu"
        ),
        false
      );?>

    </div>
  </div>

  <?php if ($main): ?>

  <main class="main-index-page container no-padding-container">

    <div class="main-menu desktop">
      <?$APPLICATION->IncludeComponent(
          "bitrix:menu",
          "main_catalog_menu",
          array(
            "ALLOW_MULTI_SELECT" => "N",
            "CHILD_MENU_TYPE" => "left",
            "DELAY" => "N",
            "MAX_LEVEL" => "1",
            "MENU_CACHE_GET_VARS" => array(
            ),
            "MENU_CACHE_TIME" => "36000000",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "ROOT_MENU_TYPE" => "left",
            "USE_EXT" => "Y",
            "COMPONENT_TEMPLATE" => "main_catalog_menu"
          ),
          false
        );?>
    </div>

    <div class="main-block index-page">

      <?php else: ?>

      <main>

        <div class="main-block not-index-page">

          <div class="container">
            <div class="row">
              <div class="main-menu desktop">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "main_catalog_menu",
                    Array(
                      "ALLOW_MULTI_SELECT" => "N",
                      "CHILD_MENU_TYPE" => "left",
                      "DELAY" => "N",
                      "MAX_LEVEL" => "1",
                      "MENU_CACHE_GET_VARS" => array(""),
                      "MENU_CACHE_TIME" => "3600",
                      "MENU_CACHE_TYPE" => "A",
                      "MENU_CACHE_USE_GROUPS" => "Y",
                      "ROOT_MENU_TYPE" => "left",
                      "USE_EXT" => "Y"
                    )
                  );?>
              </div>
            </div>
          </div>

          <?php endif; ?>

          <?php if ($page == "contacts") $no_padding_container = "contacts-container no-padding-container"; ?>

          <div class="container <?=$no_padding_container?>">
            <div class="row">
              <div class="col main-col">