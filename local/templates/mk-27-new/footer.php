<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?php 
        if ($APPLICATION->GetProperty('isProduct') == "Y")
        {
            $APPLICATION->SetPageProperty("og-title", $APPLICATION->GetProperty('og-title'));
            $APPLICATION->SetPageProperty("og-description", $APPLICATION->GetProperty('og-description'));
            $APPLICATION->SetPageProperty("og-image", $APPLICATION->GetProperty('og-image'));
        }
        else
        {
            $APPLICATION->SetPageProperty("og-title", "<meta property='og:title' content='".$APPLICATION->GetTitle()."'>");
            $APPLICATION->SetPageProperty("og-description", "<meta property='og:description' content='".$APPLICATION->GetProperty("description")."'>");
            $APPLICATION->SetPageProperty("og-image", "<meta property='og:image' content='https://" . SITE_SERVER_NAME . "/local/templates/mk-27-new/assets/images/mkOpenGraph.png'>");
        }
        ?>

</div> <?php // .row ?>
</div> <?php // .container ?>
</main>

<?php if ($page != "/" && $page != "/contacts/") $footer_margin_top = "class='footer-margin-top'"; ?>

<footer <?=$footer_margin_top?>>

  <div class="container footer-block">
    <div class="row">

      <div class="col">

        <h3>
          <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
                        		"PATH" => SITE_TEMPLATE_PATH . "/include/footer/footer_col_1_title.php"
                        	));?>
        </h3>
        <div class="footer-text fs-14">
          <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
							    "PATH" => SITE_TEMPLATE_PATH . "/include/footer/footer_text_".$city_code."_1.php"
                        	));?>
        </div>
        <div class="footer-link">
          <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
                        		"PATH" => SITE_TEMPLATE_PATH . "/include/footer/footer_link_".$city_code."_1.php"
                        	));?>
        </div>
        <div class="footer-text fs-14">
          <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
                        		"PATH" => SITE_TEMPLATE_PATH . "/include/footer/footer_text_2.php"
                        	));?>
        </div>
        <div class="footer-link">
          <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
                        		"PATH" => SITE_TEMPLATE_PATH . "/include/footer/footer_link_".$city_code."_2.php"
                        	));?>
        </div>
      </div>

      <div class="col">
        <h3>
          <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
                        		"PATH" => SITE_TEMPLATE_PATH . "/include/footer/footer_col_2_title.php"
                        	));?>
        </h3>
        <?$APPLICATION->IncludeComponent(
                        	"bitrix:menu",
                        	"footer_menu",
                        	Array(
                        		"ALLOW_MULTI_SELECT" => "N",
                        		"CHILD_MENU_TYPE" => "left",
                        		"DELAY" => "N",
                        		"MAX_LEVEL" => "1",
                        		"MENU_CACHE_GET_VARS" => array(""),
                        		"MENU_CACHE_TIME" => "3600",
                        		"MENU_CACHE_TYPE" => "A",
                        		"MENU_CACHE_USE_GROUPS" => "Y",
                        		"ROOT_MENU_TYPE" => "bottom",
                        		"USE_EXT" => "N"
                        	)
                        );?>
      </div>

      <div class="col">
        <h3>
          <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
                        		"PATH" => SITE_TEMPLATE_PATH . "/include/footer/footer_col_3_title.php"
                        	));?>
        </h3>
        <?$APPLICATION->IncludeComponent(
                        	"bitrix:menu",
                        	"footer_menu",
                        	Array(
                        		"ALLOW_MULTI_SELECT" => "N",
                        		"CHILD_MENU_TYPE" => "left",
                        		"DELAY" => "N",
                        		"MAX_LEVEL" => "1",
                        		"MENU_CACHE_GET_VARS" => array(""),
                        		"MENU_CACHE_TIME" => "3600",
                        		"MENU_CACHE_TYPE" => "A",
                        		"MENU_CACHE_USE_GROUPS" => "Y",
                        		"ROOT_MENU_TYPE" => "bottom_2",
                        		"USE_EXT" => "N"
                        	)
                        );?>
      </div>

      <div class="col">
        <h3>
          <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
                        		"PATH" => SITE_TEMPLATE_PATH . "/include/footer/footer_col_4_title.php"
                        	));?>
        </h3>
        <?$APPLICATION->IncludeComponent(
                        	"bitrix:menu",
                        	"footer_menu",
                        	Array(
                        		"ALLOW_MULTI_SELECT" => "N",
                        		"CHILD_MENU_TYPE" => "left",
                        		"DELAY" => "N",
                        		"MAX_LEVEL" => "1",
                        		"MENU_CACHE_GET_VARS" => array(""),
                        		"MENU_CACHE_TIME" => "3600",
                        		"MENU_CACHE_TYPE" => "A",
                        		"MENU_CACHE_USE_GROUPS" => "Y",
                        		"ROOT_MENU_TYPE" => "bottom_3",
                        		"USE_EXT" => "N"
                        	)
                        );?>
      </div>

      <div class="col">

        <h3>
          <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
                        		"PATH" => SITE_TEMPLATE_PATH . "/include/footer/footer_col_5_title.php"
                        	));?>
        </h3>

        <div class="footer-social">
          <a href="https://wa.me/79145443019" target="_blank">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/ic-wa-black.svg">
            <span>WhatsApp</span>
          </a>
          <a href="https://t.me/metiz_komplekt27" target="_blank">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/ic-telegram-black.svg">
            <span>Telegram</span>
          </a>
          <a href="https://vk.com/metiz_komplekt27" target="_blank">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/ic-vk-black.svg">
            <span>ВКонтакте</span>
          </a>
        </div>

      </div>

    </div>
  </div>

  <div class="copyrights">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
                        		"PATH" => SITE_TEMPLATE_PATH . "/include/footer/footer_copyright.php"
                        	));?>
        </div>
      </div>
    </div>
  </div>

</footer>

<div itemscope itemtype="https://schema.org/Organization" style="display: none;">
  <meta itemprop="name" content="Метиз Комплект" />
  <link itemprop="url" href="<?=$_SERVER['HTTP_HOST']?>" />
  <link itemprop="logo" href="<?=$_SERVER['HTTP_HOST']?>/local/templates/mk-27-new/images/logo.png" />
  <meta itemprop="description"
    content="Купить крепеж, строительное оборудование и инструменты оптом и в розницу в компании Метиз Комплект. Доступные цены. Быстрая доставка во Владивостоке, Хабаровске, Южно-Сахалинске.  Обращайтесь!" />
  <meta itemprop="email" content="919044@mail.ru" />
  <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
    <meta itemprop="addressLocality" content="Хабаровск, Россия" />
    <meta itemprop="postalCode" content="680000" />
    <meta itemprop="streetAddress" content="ул. Иртышская, 25" />
  </div>
  <meta itemprop="telephone" content="+7 (4212) 91-90-43" />
</div>

</body>

</html>