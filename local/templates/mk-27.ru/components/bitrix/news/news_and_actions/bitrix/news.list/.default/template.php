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

<div class="news-list no-padding-container container">
	<h1>Новости и акции</h1>
	
	<div class="row">
	
    	<?php foreach($arResult["ITEMS"] as $arItem):
        	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        
        	<div class="col-4 col-md-3 item item-2">
        		<a class="image-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
        			<div class="image" style="background-image: url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>');"></div>
        		</a>
        		<div class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
        		<div class="title">
        			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
        				<?=$arItem["NAME"]?>
    				</a>
        		</div>
        	</div>
        
        <?php endforeach; ?>
	
	</div>
		  
    <?php if($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    	<?=$arResult["NAV_STRING"];?>
    <?php endif; ?>
	    	
</div>