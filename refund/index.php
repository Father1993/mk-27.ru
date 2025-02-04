<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обмен и возврат товара");
?>

<div class="page-main-block refund">

	<section>
		<h1>
			<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        		"PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_header.php"
        	));?>
		</h1>
		<h2>
			<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        		"PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_1_title.php"
        	));?>
		</h2>
		<div class="text">
			<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        		"PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_1_text.php"
        	));?>
		</div>
	</section>
	
	<section>
		<h2>
			<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        		"PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_2_title.php"
        	));?>
		</h2>
		<div class="text">
			<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        		"PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_2_text.php"
        	));?>
		</div>
	</section>
	
	<section>
		<h2>
			<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        		"PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_3_title.php"
        	));?>
		</h2>
		<div class="text">
			<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        		"PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_3_text.php"
        	));?>
		</div>
	</section>
	
	<section>
		<h2>
			<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        		"PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_4_title.php"
        	));?>
		</h2>
		<div class="text">
			<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        		"PATH" => SITE_TEMPLATE_PATH . "/include/refund/main_block_4_text.php"
        	));?>
		</div>
	</section>


</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>