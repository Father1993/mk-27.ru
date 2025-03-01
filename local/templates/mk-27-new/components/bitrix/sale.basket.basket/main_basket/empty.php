<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>

<h1 class="empty-cart-title">Корзина</h1>

<div class="empty-cart">

	<div class="image">
	
        <svg xmlns="http://www.w3.org/2000/svg" width="129.188" height="114.562" viewBox="0 0 129.188 114.562">
			<path class="cls-1" d="M710.628,516.914a12.689,12.689,0,0,0,0,25.378A12.689,12.689,0,1,0,710.628,516.914Zm67.374,0a12.689,12.689,0,1,0,0,25.378A12.689,12.689,0,0,0,778,516.914Zm19.942-70.42a5.206,5.206,0,0,0-4.068-1.949H698.271L693.3,431.107a5.206,5.206,0,0,0-4.88-3.4H675.11a5.206,5.206,0,0,0,0,10.411h9.683L709.557,505a5.2,5.2,0,0,0,4.88,3.389c0.207,0,.417-0.013.624-0.027l69.421-8.331a5.218,5.218,0,0,0,4.473-4.046l10.019-45.108A5.215,5.215,0,0,0,797.944,446.494Zm-14.018,24.079h-20.8V454.956H787.4Zm-46.826,0V454.956h20.825v15.617H737.1Zm20.825,5.205v16.953L737.1,495.225V475.771h20.825v0.007Zm-26.031-20.822v15.617H707.906l-5.781-15.617h29.769Zm-22.059,20.822h22.059v20.084l-14,1.681Zm53.3,16.329V475.778h19.643l-3.186,14.35Z" transform="translate(-669.906 -427.719)"/>
        </svg>
        
	</div>
	
	<div class="large-text">Ваша корзина пуста</div>
	
	<div class="text">
		Чтобы продолжить покупки, перейдите на <a href="/">главную страницу</a>, воспользуйтесь <a href="/catalog/">каталогом</a> или поиском
	</div>
	
</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.products.viewed",
	"catalog_products_viewed",
	Array(
		"ACTION_VARIABLE" => "action_cpv",
		"ADDITIONAL_PICT_PROP_5" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"BASKET_URL" => "/personal/basket.php",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DEPTH" => "2",
		"DISPLAY_COMPARE" => "N",
		"ENLARGE_PRODUCT" => "STRICT",
		"HIDE_NOT_AVAILABLE" => "Y",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"IBLOCK_ID" => "5",
		"IBLOCK_MODE" => "single",
		"IBLOCK_TYPE" => "catalog",
		"LABEL_PROP_5" => array(),
		"LABEL_PROP_POSITION" => "top-left",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"PAGE_ELEMENT_COUNT" => "9",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array("BASE"),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SECTION_CODE" => "",
		"SECTION_ELEMENT_CODE" => "",
		"SECTION_ELEMENT_ID" => $GLOBALS["CATALOG_CURRENT_ELEMENT_ID"],
		"SECTION_ID" => $GLOBALS["CATALOG_CURRENT_SECTION_ID"],
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
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?>


<?php /* ?>
<div class="bx-sbb-empty-cart-container">
	<div class="bx-sbb-empty-cart-image">
		<img src="" alt="">
	</div>
	<div class="bx-sbb-empty-cart-text"><?=Loc::getMessage("SBB_EMPTY_BASKET_TITLE")?></div>
	<?
	if (!empty($arParams['EMPTY_BASKET_HINT_PATH']))
	{
		?>
		<div class="bx-sbb-empty-cart-desc">
			<?=Loc::getMessage(
				'SBB_EMPTY_BASKET_HINT',
				[
					'#A1#' => '<a href="'.$arParams['EMPTY_BASKET_HINT_PATH'].'">',
					'#A2#' => '</a>',
				]
			)?>
		</div>
		<?
	}
	?>
</div>
<?php */ ?>