<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обмен и возврат товара");
?>

<div class="refund-page">
  <!-- Hero секция -->
  <section class="refund-hero">
    <div class="hero-background"></div>
    <div class="container">
      <h1 class="refund-title">
        <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_header.php"
                ));?>
      </h1>
      <div class="refund-subtitle">Мы заботимся о качестве нашей продукции и сервиса</div>
    </div>
  </section>

  <!-- Основная информация -->
  <section class="refund-info">
    <div class="container">
      <div class="info-grid">
        <div class="info-block">
          <h2>
            <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_2_title.php"
                        ));?>
          </h2>
          <div class="text">
            <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_2_text.php"
                        ));?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Процесс возврата -->
  <section class="refund-process">
    <div class="container">
      <h2>
        <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_3_title.php"
                ));?>
      </h2>
      <div class="process-grid">
        <div class="process-content">
          <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_3_text.php"
                    ));?>
        </div>
      </div>
    </div>
  </section>

  <!-- Дополнительная информация -->
  <section class="refund-additional">
    <div class="container">
      <h2>
        <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_4_title.php"
                ));?>
      </h2>
      <div class="additional-content">
        <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_4_text.php"
                ));?>
      </div>
    </div>
  </section>

  <!-- Форма обратной связи -->
  <section class="refund-contact">
    <div class="container">
      <div class="contact-wrapper">
        <h2>Остались вопросы?</h2>
        <p>Наши специалисты готовы помочь вам с возвратом или обменом товара</p>
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
</div>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>