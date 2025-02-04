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

<h3 class="emploeers-photos-title"><?=$arResult["NAME"]?></h3>

<div class="emploeers-photos container">

	<div class="row">
	
    	<?php foreach ($arResult["ITEMS"] as $arItem): ?>
        	<?
        	$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        	$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        	
        	$photoSmall = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array("width"=>"600", "height"=>"300"), BX_RESIZE_IMAGE_PROPORTIONAL_ALL, true);
        	
        	?>
    
    		<div class="col-12 col-md-6 col-lg-3 col-xl-2 item">
            	<a href="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" data-fancybox="emploeers-photos">
                	<div class="item-inner">
            			<div class="picture" style="background-image: url('<?=$photoSmall["src"]?>');"></div>
                	</div>
            	</a>
        	</div>
    
    	<?php endforeach; ?>
	
	</div>
</div>

<a class="emploeers-photos-link-see-all" href="#">Смотреть все фото →</a>
