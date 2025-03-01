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

<div class="news-detail">
	<h1><?=$arResult["NAME"]?></h1>
	
	<div class="row">
    	<div class="col">
    	
    		<?php if ($arResult["DETAIL_PICTURE"]["SRC"]): ?>
        		<div class="image-block">
        			<img class="title-image" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
        		</div>
    		<?php endif; ?>
    		
    		<?php if ($arResult["DISPLAY_ACTIVE_FROM"]): ?>
        		<div class="date">
        			<?=$arResult["DISPLAY_ACTIVE_FROM"]?>
        		</div>
    		<?php endif; ?>
    		
    		<span class="text">
    			<?=$arResult["DETAIL_TEXT"]?>
    		</span>
        	
    	</div>
	</div>
</div>
