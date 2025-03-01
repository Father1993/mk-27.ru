<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?> 
<div class="main-popular-products-head">
    <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
    	"PATH" => SITE_TEMPLATE_PATH . "/components/bitrix/catalog.section/main_popular_products/include/title.php"
    ));?>
   </div>

<div class="main-popular-products container">

	<div class="row">
    
    	<?php foreach($arResult["ITEMS"] as $arItem):
        	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
        	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
        	
        	$arImage = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array("width"=>"300", "height"=>"400"), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        	
        	if (empty($arImage["src"])) $arImage["src"] = SITE_TEMPLATE_PATH . "/assets/images/placeholder.jpg";
    	?>
    
    	<div class="product-block col-6 col-sm-4 col-lg-3" id="<?=$this->GetEditAreaId($arElement['ID']);?>" itemscope itemtype="http://schema.org/Product">
    	
        	<div class="product-image">
    			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
    				<img itemprop="image" src="<?=$arImage["src"];?>" alt="<?=$arItem["NAME"]?>">
    			</a>
        	</div>
        	
        	<div class="product-name">
        		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" itemprop="url">
        			<span itemprop="name"><?=$arItem["NAME"]?></span>
        		</a>
        		<?php if ($arItem["DETAIL_TEXT"]): ?>
        		<div itemprop="description" class="hidden"><?=$arItem["DETAIL_TEXT"]?></div>
        		<?php else: ?>
        		<div itemprop="description" class="hidden"><?=$arItem["PREVIEW_TEXT"]?></div>
        		<?php endif; ?>
        	</div>
        	
        	<div class="product-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        		<link itemprop="url" href="<?=$arItem["DETAIL_PAGE_URL"]?>" />
    			<meta itemprop="priceCurrency" content="RUB">
                <meta itemprop="availability" content="http://schema.org/InStock" />
            	<span>
            		<?php foreach ($arItem["PRICES"] as $price): ?>
            			<?php if ($price["VALUE"] > 0): ?>
                			<?=number_format($price["VALUE"], 2, '.', ' ');?><i class="fa fa-rub" aria-hidden="true"></i>
                			<meta itemprop="price" content="<?=$price["VALUE"]?>">
            			<?php else: ?>
            				Под заказ
            			<?php endif; ?>
            		<?php endforeach; ?>
        		</span>
        	</div>
        	
    		<?php if ($USER->IsAdmin()): ?>
            <div class="quantity">
            	Остаток: <strong><?=$arItem["PRODUCT"]["QUANTITY"]?></strong>
            </div>
            <?php endif; ?>
    		
    	</div>
    	
    	<?php endforeach; ?>

	</div>
</div>

