<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
?>

<?php if ($price["PRICE"] > 0): ?>
<div class="catalog-item" itemscope itemtype="http://schema.org/Product">
<?php else: ?>
<div class="catalog-item">
<?php endif; ?>

<?php /* ?>
	<div class="compare">
		<label id="<?=$itemIds['COMPARE_LINK']?>">
			<input type="checkbox" data-entity="compare-checkbox">
			<span data-entity="compare-title"><?=$arParams['MESS_BTN_COMPARE']?></span>
		</label>
	</div>
<?php */ ?>

    <?php 
    
    $photoSmall = CFile::ResizeImageGet($item['DETAIL_PICTURE']["ID"], array("width"=>"300", "height"=>"400"), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    if (empty($photoSmall["src"])) $photoSmall["src"] = SITE_TEMPLATE_PATH . "/assets/images/placeholder.jpg";
	?>

	<a itemprop="url" href="<?=$item['DETAIL_PAGE_URL']?>">
    	<div class="image" style="background-image: url(<?=$photoSmall['src']?>);"></div>
    	<div itemprop="name" class="title"><?=$item["NAME"]?></div>
    	<img itemprop="image" style="display: none;" src="<?=$photoSmall['src']?>" alt="<?=$item["NAME"]?>">
	</a>
	
	<div class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
		<meta itemprop="priceCurrency" content="RUB">
        <meta itemprop="availability" content="http://schema.org/InStock" />
        <?php if ($price["PRICE"] > 0): ?>
    		<meta itemprop="price" content="<?=$price["PRICE"]?>">
    		<span><?=number_format($price["PRICE"], 2, '.', ' ');?><i class="fa fa-rub"></i></span>
		<?php else: ?>
			<span>Под заказ</span>
		<?php endif; ?>
		<span class="product-item-amount-description-container">
			<span id="<?=$itemIds['QUANTITY_MEASURE']?>">
				<?=$actualItem['ITEM_MEASURE']['TITLE']?>
			</span>
			<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
		</span>
	</div>
	
	<?php if ($item["DETAIL_TEXT"]): ?>
		<div itemprop="description" class="hidden"><?=str_replace("&nbsp;", " ", preg_replace('/\s+/', ' ', $item["DETAIL_TEXT"]))?></div>
	<?php else: ?>
		<div itemprop="description" class="hidden"><?=str_replace("&nbsp;", " ", preg_replace('/\s+/', ' ', $item["PREVIEW_TEXT"]))?></div>
	<?php endif; ?>
	
	<?php if ($price["PRICE"] > 0): ?>
	
        <?php if ($APPLICATION->GetCurPage() !== "/izbrannoe/"): ?>
        	<div class="product-item-info-container product-item-hidden" data-entity="quantity-block">
        		<div class="product-item-amount">
        			<div class="product-item-amount-field-container">
        				<span class="product-item-amount-field-btn-minus" id="<?=$itemIds['QUANTITY_DOWN']?>"></span>
        				<input class="product-item-amount-field" id="<?=$itemIds['QUANTITY']?>" type="number"
        					name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
        					value="<?=$measureRatio?>">
        				<span class="product-item-amount-field-btn-plus" id="<?=$itemIds['QUANTITY_UP']?>"></span>
    
        			</div>
        		</div>
        	</div>
        <?php endif; ?>
        
    <?php endif; ?>

	<div class="buttons-block">
	
		<?php if ($price["PRICE"] > 0): ?>
	
        	<div class="product-item-button-container" id="<?=$itemIds['BASKET_ACTIONS']?>">
        		<a class="btn btn-default <?=$buttonSizeClass?>" id="<?=$itemIds['BUY_LINK']?>"
        			href="javascript:void(0)" rel="nofollow">
        			<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
        		</a>
        	</div>
        	
    	<?php endif; ?>
    	
		<div class="favorite" data-item="<?=$item["ID"]?>">
			<div class="hint">
				<div class="hint-arrow"></div>
				Добавить в избранное
			</div>
			<div class="hint-delete">
				<div class="hint-arrow"></div>
				Убрать из избранного
			</div>
			<i class="fa fa-heart"></i>
		</div>
	</div>

	<?php if ($USER->IsAdmin()): ?>
        <div class="quantity">
        	Остаток: <strong><?=$item["PRODUCT"]["QUANTITY"]?></strong>
        </div>
    <?php endif; ?>

	<?php /**/ // Этот блок нужен для того, чтобы работало количество ?>
	<div class="product-item-info-container product-item-price-container" data-entity="price-block">
		<span class="product-item-price-current" id="<?=$itemIds['PRICE']?>">
		</span>
	</div>
	
</div>

<div class="product-item">
	<? if ($itemHasDetailUrl): ?>
	<a class="product-item-image-wrapper" href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$imgTitle?>"
			data-entity="image-wrapper">
	<? else: ?>
	<span class="product-item-image-wrapper" data-entity="image-wrapper">
	<? endif; ?>
		<span class="product-item-image-slider-slide-container slide" id="<?=$itemIds['PICT_SLIDER']?>"
			<?=($showSlider ? '' : 'style="display: none;"')?>
			data-slider-interval="<?=$arParams['SLIDER_INTERVAL']?>" data-slider-wrap="true">
			<?
			if ($showSlider)
			{
				foreach ($morePhoto as $key => $photo)
				{
					?>
					<span class="product-item-image-slide item <?=($key == 0 ? 'active' : '')?>"
						style="background-image: url('<?=$photo['SRC']?>');">
					</span>
					<?
				}
			}
			?>
		</span>
		<span class="product-item-image-original" id="<?=$itemIds['PICT']?>"
			style="background-image: url('<?=$photoSmall['src']?>'); <?=($showSlider ? 'display: none;' : '')?>">
		</span>
		<?
		if ($item['SECOND_PICT'])
		{
			$bgImage = !empty($item['DETAIL_PICTURE_SECOND']) ? $item['DETAIL_PICTURE_SECOND']['SRC'] : $item['PREVIEW_PICTURE']['SRC'];
			?>
			<span class="product-item-image-alternative" id="<?=$itemIds['SECOND_PICT']?>"
				style="background-image: url('<?=$bgImage?>'); <?=($showSlider ? 'display: none;' : '')?>">
			</span>
			<?
		}

		if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
		{
			?>
			<div class="product-item-label-ring <?=$discountPositionClass?>" id="<?=$itemIds['DSC_PERC']?>"
				<?=($price['PERCENT'] > 0 ? '' : 'style="display: none;"')?>>
				<span><?=-$price['PERCENT']?>%</span>
			</div>
			<?
		}
		if ($item['LABEL'])
		{
			?>
			<div class="product-item-label-text <?=$labelPositionClass?>" id="<?=$itemIds['STICKER_ID']?>">
				<?
				if (!empty($item['LABEL_ARRAY_VALUE']))
				{
					foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value)
					{
						?>
						<div<?=(!isset($item['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
							<span title="<?=$value?>"><?=$value?></span>
						</div>
						<?
					}
				}
				?>
			</div>
			<?
		}
		?>
		<div class="product-item-image-slider-control-container" id="<?=$itemIds['PICT_SLIDER']?>_indicator"
			<?=($showSlider ? '' : 'style="display: none;"')?>>
			<?
			if ($showSlider)
			{
				foreach ($morePhoto as $key => $photo)
				{
					?>
					<div class="product-item-image-slider-control<?=($key == 0 ? ' active' : '')?>" data-go-to="<?=$key?>"></div>
					<?
				}
			}
			?>
		</div>
		<?
		if ($arParams['SLIDER_PROGRESS'] === 'Y')
		{
			?>
			<div class="product-item-image-slider-progress-bar-container">
				<div class="product-item-image-slider-progress-bar" id="<?=$itemIds['PICT_SLIDER']?>_progress_bar" style="width: 0;"></div>
			</div>
			<?
		}
		?>
	<? if ($itemHasDetailUrl): ?>
	</a>
	<? else: ?>
	</span>
	<? endif; ?>
	<div class="product-item-title">
		<? if ($itemHasDetailUrl): ?>
		<a href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$productTitle?>">
		<? endif; ?>
		<?=$productTitle?>
		<? if ($itemHasDetailUrl): ?>
		</a>
		<? endif; ?>
	</div>

</div>

