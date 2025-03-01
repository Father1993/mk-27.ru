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
<div class="main-slider">
    <div class="owl-carousel">
    
        <?php foreach ($arResult["ITEMS"] as $key => $item): ?>
        	<?
        	$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        	$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        	?>
		<a href="<?=$item["PROPERTIES"]["LINK"]["VALUE"]?>">
        	<div class="slider"  id="<?=$this->GetEditAreaId($item['ID']);?>" style="background-image: url('<?=$item["DETAIL_PICTURE"]["SRC"]?>');">
				<? /*if(isset($item["PROPERTIES"]["SUBTITLE"]["VALUE"]) && strlen($item["PROPERTIES"]["SUBTITLE"]["VALUE"]) > 0) { ?>
				<div class="text-block">
        			<?php if ($item["PROPERTIES"]["SUBTITLE"]["VALUE"]): ?>
            			<div class="description"><?=$item["PROPERTIES"]["SUBTITLE"]["VALUE"]?></div>
            		<?php endif; ?>
            		<div class="title"><?=$item["NAME"]?></div>
            		<?php if ($item["PROPERTIES"]["LINK"]["VALUE"] && $item["PROPERTIES"]["LINK_TEXT"]["VALUE"]): ?>
            			<div class="link"><a href="<?=$item["PROPERTIES"]["LINK"]["VALUE"]?>"><?=$item["PROPERTIES"]["LINK_TEXT"]["VALUE"]?></a></div>
        			<?php endif; ?>
        		</div>
<? } */?>
        	</div>
	</a>
        <?php endforeach; ?>
        
    </div>
    
    <script>
    $('.owl-carousel').owlCarousel({
    	loop: true,
    	margin: 0,
    	nav: true,
    	navText: "",
    	items: 1,
    	autoHeight: true,
    	autoplay: true,
    	autoplayTimeout: 10000,
    	autoplayHoverPause: true,
    })
    </script>
</div>
