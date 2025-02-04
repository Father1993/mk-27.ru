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

<div class="team container no-padding-container">
	<div class="row">
    	
    	<h2>
    		<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
        		"PATH" => SITE_TEMPLATE_PATH . "/include/team_title.php"
        	));?>
    	</h2>
    	
    	<?php foreach ($arResult["ITEMS"] as $item):?>
    		<?
        	$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        	$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        	?>
        	<div class="item col-6 col-sm-4 col-xl-3" id="<?=$this->GetEditAreaId($item['ID']);?>">
        	
        		<img src="<?=$item["DETAIL_PICTURE"]["SRC"]?>">
        		
        		<?php
        		$name = explode(" ", $item["NAME"]);
        		$fname = $name[0];
        		$sname = $name[1];
        		?>
        		
        		<h3><?=$fname . "<br>" . $sname?></h3>
    		
    			<?php if ($item["PROPERTIES"]["POSITION"]["VALUE"]): ?>
    				<p class="position"><?=$item["PROPERTIES"]["POSITION"]["VALUE"]?></p>
    			<?php endif; ?>
    			
    			<?php if ($item["PROPERTIES"]["PHONE_PLUS_CODE"]["VALUE"]): ?>
    				<?php $phone_to_link = preg_replace('![^0-9]+!', '',explode("+", $item["PROPERTIES"]["PHONE_PLUS_CODE"]["VALUE"])[1]); ?>
    				<div class="phone-block">
    					<a href="tel:+<?=$phone_to_link?>"><?=$item["PROPERTIES"]["PHONE_PLUS_CODE"]["VALUE"]?></a>
    				</div>
    			<?php endif; ?>
    			
    			<?php if ($item["PROPERTIES"]["PHONE_PLUS_CODE_2"]["VALUE"]): ?>
    				<?php $phone_to_link_2 = preg_replace('![^0-9]+!', '',explode("+", $item["PROPERTIES"]["PHONE_PLUS_CODE_2"]["VALUE"])[1]); ?>
    				<div class="phone-block">
    					<a href="tel:+<?=$phone_to_link_2?>"><?=$item["PROPERTIES"]["PHONE_PLUS_CODE_2"]["VALUE"]?></a>
    				</div>
    			<?php endif; ?>
    			
    			<?php if ($item["PROPERTIES"]["EMAIL"]["VALUE"]): ?>
    				<a class="email" href="mailto:<?=$item["PROPERTIES"]["EMAIL"]["VALUE"]?>"><?=$item["PROPERTIES"]["EMAIL"]["VALUE"]?></a>
    			<?php endif; ?>
        		
        	</div>
        
    	<?php endforeach; ?>
	
	</div>
</div>