<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arItem */
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

<h3 class="emploeers-leaders-title"><?=$arResult["NAME"]?></h3>

<div class="emploeers-leaders-slider owl-carousel">
	
	<?php foreach ($arResult["ITEMS"] as $arItem): ?>
    	<?
    	$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
    	$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    	
    	$photoSmall = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array("width"=>"250", "height"=>"250"), BX_RESIZE_IMAGE_PROPORTIONAL_ALL, true);
    	
    	?>	
			<div class="emploeers-leaders-slider__item">
			
    			<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>">
        		
        		<?php
        		$name = explode(" ", $arItem["NAME"]);
        		$fname = $name[0];
        		$sname = $name[1];
        		?>
        		
        		<h3><?=$fname . "<br>" . $sname?></h3>
    		
    			<?php if ($arItem["PROPERTIES"]["POSITION"]["VALUE"]): ?>
    				<p class="position"><?=$arItem["PROPERTIES"]["POSITION"]["VALUE"]?></p>
    			<?php endif; ?>
    			
			</div>

	<?php endforeach; ?>
	
</div>

<script>
$('.emploeers-leaders-slider').owlCarousel({
    loop: true,
    margin: 15,
    nav: true,
	lazyLoad: true,
			responsive:{
        0:{
            items:1
        },
        576:{
            items:1
        },
        768:{
            items:2
        },
        991:{
            items:3
        },
        1200:{
            items:4
        }
    }
})
</script>