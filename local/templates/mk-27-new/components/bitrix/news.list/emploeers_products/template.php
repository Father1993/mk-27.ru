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

<h3 class="emploeers-products-title"><?=$arResult["NAME"]?></h3>

<div class="emploeers-products-slider owl-carousel">

	
	
	<?php foreach ($arResult["ITEMS"] as $arItem): ?>
    	<?
    	$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
    	$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    	
    	$photoSmall = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array("width"=>"600", "height"=>"300"), BX_RESIZE_IMAGE_PROPORTIONAL_ALL, true);
    	
    	?>	
	
    	<div class="emploeers-products-slider__item" style="background-image: url('<?=$photoSmall["src"]?>')" id="<?=$this->GetEditAreaId($item['ID']);?>">
    		<div class="emploeers-products-slider__text">
    			<?=$arItem["NAME"]?>
    		</div>
    	</div>

	<?php endforeach; ?>
	
</div>

<script>
$('.emploeers-products-slider').owlCarousel({
    loop: true,
    margin: 15,
    nav: true,
	lazyLoad: true,
			responsive:{
        0:{
            items:2
        },
        576:{
            items:3
        },
        768:{
            items:4
        },
        991:{
            items:5
        },
        1200:{
            items:6
        }
    }
})
</script>